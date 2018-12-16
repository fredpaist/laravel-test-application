<?php

namespace App\Http\Requests;

use App\Sectors;
use App\Visitor;
use Illuminate\Foundation\Http\FormRequest;

class VisitorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'terms' => 'required',
            'sectors' => 'required|max:5'
        ];
    }

    public function processRequest()
    {
        if ($data_id = $this->session()->get('saved_id')){
            $visitor = Visitor::find($data_id);
        } else {
            $visitor = new Visitor();
        }

        $visitor->build($this->all());
        $visitor->save();

        if ($this->get('sectors')) {
            $sectors = Sectors::whereIn('value', $this->get('sectors'))->pluck('id')->toArray();
            $visitor->syncSectors($sectors);
        }

        $this->session()->put('saved_id', $visitor->id);
    }
}
