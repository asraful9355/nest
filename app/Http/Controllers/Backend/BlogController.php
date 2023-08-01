<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Image;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function AllBlogCateogry(){

        $blogcategoryies = BlogCategory::latest()->get();
        return view('backend.blog.category.blogcategroy_all',compact('blogcategoryies'));

    } // End Method 

    public function AddBlogCateogry(){
        return view('backend.blog.category.blogcategroy_add');
    } // End Method 

    public function StoreBlogCateogry(Request $request){

        $blogCategory = new BlogCategory;

        $blogCategory->blog_category_name_en = $request->blog_category_name_en;
        if($request->blog_category_name_bn == ''){
            $blogCategory->blog_category_name_bn = $request->blog_category_name_en;
        }else{
            $blogCategory->blog_category_name_bn = $request->blog_category_name_bn;
        }

        $blogCategory->blog_category_slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->blog_category_name_en)));

        $blogCategory->created_at = Carbon::now();
        $blogCategory->save();

       $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification); 

    }// End Method 


    public function EditBlogCateogry($id){

        $blogcategory = BlogCategory::findOrFail($id);
        return view('backend.blog.category.blogcategroy_edit',compact('blogcategory'));

    }// End Method 

     public function UpdateBlogCateogry(Request $request,$id){
       
      $blogCategory = BlogCategory::findOrFail($id);
      $blogCategory->blog_category_name_en = $request->blog_category_name_en;
      if($request->blog_category_name_bn == ''){
          $blogCategory->blog_category_name_bn = $request->blog_category_name_en;
      }else{
          $blogCategory->blog_category_name_bn = $request->blog_category_name_bn;
      }

      $blogCategory->blog_category_slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->blog_category_name_en)));

      $blogCategory->created_at = Carbon::now();
      $blogCategory->save();

     $notification = array(
          'message' => 'Blog Category Updaetd Successfully',
          'alert-type' => 'success'
      );

      return redirect()->route('admin.blog.category')->with($notification); 


    }// End Method 


    public function DeleteBlogCateogry($id){
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method 

 //////////////////// Blog Post Methods //////////////////


 public function AllBlogPost(){

        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.blogpost_all',compact('blogpost'));

    } // End Method 


    public function AddBlogPost(){
        $blogcategory = BlogCategory::latest()->get();
        return view('backend.blog.post.blogpost_add',compact('blogcategory'));
    } // End Method 

    public function StoreBlogPost(Request $request){
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1103,906)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        $blogPost = new BlogPost;

        $blogPost->post_title_en = $request->post_title_en;
        if($request->post_title_bn == ''){
            $blogPost->post_title_bn = $request->post_title_en;
        }else{
            $blogPost->post_title_bn = $request->post_title_bn;
        }

        $blogPost->post_short_description_en = $request->post_short_description_en;
        if($request->post_short_description_bn == ''){
            $blogPost->post_short_description_bn = $request->post_short_description_en;
        }else{
            $blogPost->post_short_description_bn = $request->post_short_description_bn;
        }

        $blogPost->post_long_description_en = $request->post_long_description_en;
        if($request->post_long_description_bn == ''){
            $blogPost->post_long_description_bn = $request->post_long_description_en;
        }else{
            $blogPost->post_long_description_bn = $request->post_long_description_bn;
        }

        $blogPost->post_slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->post_title_en)));
        $blogPost->category_id = $request->category_id;
        $blogPost->post_image = $save_url;
        $blogPost->created_at = Carbon::now();
        $blogPost->save();
        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification); 

    }// End Method 


    public function EditBlogPost($id){
        $blogcategory = BlogCategory::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
       return view('backend.blog.post.blogpost_edit',compact('blogcategory','blogpost'));
   }// End Method 

   public function UpdateBlogPost(Request $request, $id) {
    $blogPost = BlogPost::findOrFail($id);

    if ($request->hasFile('post_image')) {
        try {
            if (file_exists($blogPost->post_image)) {
                unlink($blogPost->post_image);
            }
        } catch (Exception $e) {
            // Handle the exception (if necessary)
        }

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1103, 906)->save('upload/blog/' . $name_gen);
        $post_image = 'upload/blog/' . $name_gen;
    } else {
        $post_image = $blogPost->post_image;
    }

    $blogPost->post_title_en = $request->post_title_en;
    $blogPost->post_title_bn = $request->post_title_bn ?: $request->post_title_en;

    $blogPost->post_short_description_en = $request->post_short_description_en;
    $blogPost->post_short_description_bn = $request->post_short_description_bn ?: $request->post_short_description_en;

    $blogPost->post_long_description_en = $request->post_long_description_en;
    $blogPost->post_long_description_bn = $request->post_long_description_bn ?: $request->post_long_description_en;

    $blogPost->post_slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->post_title_en)));
    $blogPost->category_id = $request->category_id;
    $blogPost->post_image = $post_image;
    $blogPost->created_at = Carbon::now();
    $blogPost->save();

    $notification = array(
       'message' => 'Blog Post Updated Successfully',
       'alert-type' => 'success'
    );

    return redirect()->route('admin.blog.post')->with($notification);
}

 public function DeleteBlogPost($id) {
    $blogPost = BlogPost::findOrFail($id);
    $img = $blogPost->post_image;
    unlink($img);

    $blogPost->delete();

    $notification = array(
       'message' => 'Blog Post Deleted Successfully',
       'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
 }

  //////////////////// Frontend Blog All Method //////////////


  public function AllBlog(){
    $blogcategoryies = BlogCategory::latest()->get();
    $blogpost = BlogPost::latest()->get();
    return view('frontend.blog.home_blog',compact('blogcategoryies','blogpost'));
  }// End Method 

  public function BlogDetails($id,$slug){
    $blogcategoryies = BlogCategory::latest()->get();
    $blogdetails = BlogPost::findOrFail($id);
    $breadcat = BlogCategory::where('id',$id)->get();
    return view('frontend.blog.blog_details',compact('blogcategoryies','blogdetails','breadcat'));

  }// End Method 

  public function BlogPostCategory($id,$slug){

    $blogcategoryies = BlogCategory::latest()->get();
    $blogpost = BlogPost::where('category_id',$id)->get();
    $breadcat = BlogCategory::where('id',$id)->get();
    return view('frontend.blog.category_post',compact('blogcategoryies','blogpost','breadcat'));

  }// End Method 




}