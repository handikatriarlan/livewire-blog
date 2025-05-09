<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    use WithFileUploads;

    public $postID;
    public $image;
    public $oldImage;

    #[Rule('required', message: 'Masukkan Judul Post')]
    public $title;

    #[Rule('required', message: 'Masukkan Isi Post')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $content;

    public function mount($id)
    {
        $post = Post::find($id);

        $this->postID   = $post->id;
        $this->title    = $post->title;
        $this->content  = $post->content;
        $this->oldImage = $post->image;
    }

    public function update()
    {
        $this->validate();

        $post = Post::find($this->postID);

        if ($this->image) {

            $this->image->storeAs('public/posts', $this->image->hashName());

            $post->update([
                'image' => $this->image->hashName(),
                'title' => $this->title,
                'content' => $this->content,
            ]);
        } else {

            $post->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);
        }

        session()->flash('message', 'Data Berhasil Diupdate.');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.posts.edit');
    }
}
