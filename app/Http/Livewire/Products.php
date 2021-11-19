<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Products extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $code, $name, $description, $brand, $price, $category;
    public $updateMode = false;

    public function render()
    {
        
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.products.view', [
            'products' => Product::latest()
						->orWhere('code', 'LIKE', $keyWord)
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('description', 'LIKE', $keyWord)
						->orWhere('brand', 'LIKE', $keyWord)
						->orWhere('price', 'LIKE', $keyWord)
						->orWhere('category', 'LIKE', $keyWord)
						->paginate(10),
            'categories'=> Category::all()
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->code = null;
		$this->name = null;
		$this->description = null;
		$this->brand = null;
		$this->price = null;
		$this->category = null;
    }

    public function store()
    {
        $this->validate([
		'code' => 'unique:products|required|min:4 |max:10|alpha_num',
		'name' => 'unique:products|required|min:4',
		'description' => 'required',
		'brand' => 'required',
		'price' => 'required|numeric',
		'category' => 'required',
        ]);

        Product::create([ 
			'code' => $this-> code,
			'name' => $this-> name,
			'description' => $this-> description,
			'brand' => $this-> brand,
			'price' => $this-> price,
			'category' => $this-> category
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Product Successfully created.');
    }

    public function edit($id)
    {
        $record = Product::findOrFail($id);

        $this->selected_id = $id; 
		$this->code = $record-> code;
		$this->name = $record-> name;
		$this->description = $record-> description;
		$this->brand = $record-> brand;
		$this->price = $record-> price;
		$this->category = $record-> category;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'code' => 'required',
		'name' => 'required',
		'description' => 'required',
		'brand' => 'required',
		'price' => 'required',
		'category' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Product::find($this->selected_id);
            $record->update([ 
			'code' => $this-> code,
			'name' => $this-> name,
			'description' => $this-> description,
			'brand' => $this-> brand,
			'price' => $this-> price,
			'category' => $this-> category
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Product Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Product::where('id', $id);
            $record->delete();
        }
    }
}
