<template>
    <h1>Create Post</h1>
    <form className="flex flex-col">
        <label for="">Title</label>
        <input type="text" id="title">
        
        <label for="">Image</label>
        <input type="file" id="image">

        <label for="">Category</label>
        <select name="category_id" id="categories">
            <option selected disabled>Selected Options</option>
            <option value="">Coding</option>
            <option value="">Lifestyle</option>
            <option value="">Sports</option>
        </select>

        <QuillEditor theme="snow" />
        <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Create Post</button>
        
    </form>
</template>


<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  emits: ['showNavbar'],
  components: {
    QuillEditor
  }
}
</script>