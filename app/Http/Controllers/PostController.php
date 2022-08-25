<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    function index(Request $request): View
    {
        $comments = 0;
        if (Auth::check()) {
            $posts=Post::orderBy('id','desc')->paginate(2);
        } else {
            $posts=Post::orderBy('id','desc')->where('public',true)->paginate(2);
        }

        return view('home',[
            'posts'=>$posts,
        ]);
    }

    /**
     * Post Detail
     *
     * @param Request $request
     * @param $slug
     * @param $postId
     * @return View
     */
    function detail(Request $request,$slug,$postId): View
    {
        // Update post count
        Post::find($postId)->increment('views');
    	$detail=Post::find($postId);
    	return view('detail',[
            'detail'=>$detail,
        ]);
    }

    /**
     * Save Comment
     *
     * @param Request $request
     * @param $slug
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    function save_comment(Request $request,$slug,$id)
    {
        $request->validate([
            'comment'=>'required'
        ]);
        $data=new Comment;
        $data->user_id=$request->user()->id;
        $data->post_id=$id;
        $data->comment=$request->comment;
        $data->save();
        return redirect('detail/'.$slug.'/'.$id)->with('success','Comment has been submitted.');
    }

    function edit_post_form($postId){
        $post=Post::find($postId);
        return view('edit-post-form',['post'=>$post]);
    }

    /**
     * User submit post
     *
     * @return View
     */
    function save_post_form(): View
    {
        return view('save-post-form');
    }

    /**
     * Save Data
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    function save_post_data(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'detail'=>'required',
        ]);

        // Post Thumbnail
        if($request->hasFile('post_thumb')){
            $image1=$request->file('post_thumb');
            $reThumbImage=time().'.'.$image1->getClientOriginalExtension();
            $dest1=public_path('/imgs/thumb');
            $image1->move($dest1,$reThumbImage);
        }else{
            $reThumbImage='na';
        }

        // Post Full Image
        if($request->hasFile('post_image')){
            $image2=$request->file('post_image');
            $reFullImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/full');
            $image2->move($dest2,$reFullImage);
        }else{
            $reFullImage='na';
        }

        $post=new Post;
        $post->user_id=$request->user()->id;
        $post->title=$request->title;
        $post->thumb=$reThumbImage;
        $post->full_img=$reFullImage;
        $post->detail=$request->detail;
        $post->tags=$request->tags;
        $post->save();

        return redirect('save-post-form')->with('success','Post has been added');
    }

    /**
     *  Manage Posts
     *
     * @param Request $request
     * @return View
     */
    function manage_posts(Request $request): View
    {
        $posts=Post::where('user_id', $request->user()->id)
            ->orWhere('user_id',User::ADMIN_USER_ID)
            ->orderBy('id','desc')->get();
        return view('manage-posts',['data'=>$posts]);
    }

    /**
     * @param $postId
     * @return Application|RedirectResponse|Redirector
     */
    function delete_post($postId)
    {
        $post=Post::find($postId);
        $post->comments()->delete();

        $dest1=public_path('/imgs/thumb/'.$post->thumb);
        if(File::exists($dest1)) {
            File::delete($dest1);
        }

        $dest2=public_path('/imgs/full/'.$post->thumb);
        if(File::exists($dest2)) {
            File::delete($dest2);
        }

        $post->delete();
        return redirect('manage-posts')->with('success','Post has been delete');
    }

    /**
     * @param $postId
     * @return Application|RedirectResponse|Redirector
     */
    function moderator_post($postId)
    {
        $post=Post::find($postId)->first();
        $post->moderator = ! $post->moderator;
        $post->public = $post->moderator;
        $post->update();
        return redirect('manage-posts')->with('success','Post has been update');
    }
}
