<template>
    <h1>Create Post</h1>
    <form>
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
        
    </form>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  components: {
    QuillEditor
  }
}
</script>