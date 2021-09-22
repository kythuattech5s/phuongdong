<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class BaseModel extends Model
{
    use HasFactory;
    /*method join với table dịch của insance model hiện tại*/
	public function scopePublish($q){
		return $q->where('time_published','<=',new \DateTime());
	}
	public function scopeAct($q)
	{
		return $q->where('act', 1);
	}
	public function scopeOrd($q)
	{
		return $q->orderBy('ord', 'asc')->orderBy('id', 'desc');
	}

	public function scopeDraft($q){
		$q->whereNull('is_draft');
	}

	public function scopeSlug($q, $slug, $table = null)
	{
		if ($table == null) {
			return $q->where('slug', $slug);
		}
		return $q->where("$table.slug", $slug);
	}
	public static function getNameById($id){
    	$itemService = static::find($id);
    	return isset($itemService) ? $itemService->name:'';
    }
	protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
        $words = explode(' ', $term);
        foreach ($words as $key => $word) {
            if (strlen($word) >= 1) {
                $words[$key] = '+' . $word  . '*';
            }
        }
        $searchTerm = implode(' ', $words);
        return $searchTerm;
    }
	public function scopeFullTextSearch($query, $columns, $term)
    {
        $query->select('*', \DB::raw("MATCH ({$columns}) AGAINST ('".$this->fullTextWildcards($term)."' IN NATURAL LANGUAGE MODE) as score"))->whereRaw("MATCH ({$columns}) AGAINST (? IN NATURAL LANGUAGE MODE)", $this->fullTextWildcards($term))->orderBy('score', 'desc');
        return $query;
    }
}