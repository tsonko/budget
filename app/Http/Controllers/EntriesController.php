<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Entries;



class EntriesController extends Controller
{
	protected $month;
	protected $year;

	public function __construct() {
		$this->month = 11;
		$this->year = 1984;
	}
	
    public function index() {
		
        $entries[0] = Entries::where('month',$this->month)->where('year',$this->year)->where('type','0')->get();
        $entries[1] = Entries::where('month',$this->month)->where('year',$this->year)->where('type','1')->get();
        
		return view('entries',[
			'entries'=>$entries,
			'month'=>$this->month,
			'year'=>$this->year,
		]);
		
    }

    public function create(Request $request) {
        $data = $request->validate([
			'year'=>'required|numeric',
			'month'=>'required|numeric',
			'label'=>'required|string',
			'type'=>'required|numeric',
		]);
		$data['value']=0;

		$newField = Entries::create($data);

        return(redirect(route('entries.index')));
    }
    public function update(Request $request) {
        $data = $request->validate([
            'id'=>'required',
			'label'=>'string',
			'value'=>'numeric',
		]);

        $entry = Entries::find($data['id']);
        $entry->update($data);

        return(redirect(route('entries.index')));
    }
}
