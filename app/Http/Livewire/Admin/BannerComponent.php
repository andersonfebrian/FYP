<?php

namespace App\Http\Livewire\Admin;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithPagination;

class BannerComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $listeners = [
        'removeBanner'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function removeBanner(Banner $banner) {
        $banner->delete();
        return $this->emit('removed_banner');
    }

    public function render()
    {

        $banners = Banner::where('name', 'like', '%'. $this->search . '%')->paginate(10);

        return view('livewire.admin.banner-component', ['banners' => $banners]);
    }
}
