<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLike;
    public $countLikes;

    public function mount($post){
        $this->isLike = $post->checkLike(auth()->user());
        $this->countLikes = $post->likes->count();
    }

    public function render(){
        return view('livewire.like-post');
    }

    public function like(){
        if( $this->post->checkLike(auth()->user()) ){
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLike = false;
            $this->countLikes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLike = true;
            $this->countLikes++;
        }
    }

}
