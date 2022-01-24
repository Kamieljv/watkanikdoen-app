<template>
    <div class="rich-text-editor rounded-md mt-1 p-1 border">
        <div v-if="editor" class="menu flex flex-row space-x-1 pb-2 border-b">
            <button @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
                <svg-vue icon="editor/clarity-bold-line" style="fill: currentColor;"/>
            </button>
            <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
                <svg-vue icon="editor/clarity-italic-line" style="fill: currentColor;"/>
            </button>
            <button @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'is-active': editor.isActive('italic') }">
                <svg-vue icon="editor/clarity-underline-line" style="fill: currentColor;"/>
            </button>
            <span class="divider" />
            <button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
                p
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
                H1
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
                H2
            </button>
            <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
                H3
            </button>
            <span class="divider" />
            <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
                <svg-vue icon="editor/clarity-bullet-list-line" style="fill: currentColor;"/>
            </button>
            <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
                <svg-vue icon="editor/clarity-number-list-line" style="fill: currentColor;"/>
            </button>
            <span class="divider" />
            <button @click="editor.chain().focus().toggleLink().run()" :class="{ 'is-active': editor.isActive('link') }">
                <svg-vue icon="editor/clarity-link-line" style="fill: currentColor;"/>
            </button>
            <span class="divider" />
            <button @click="editor.chain().focus().undo().run()">
                <svg-vue icon="editor/clarity-undo-line" style="fill: currentColor;"/>
            </button>
            <button @click="editor.chain().focus().redo().run()">
                <svg-vue icon="editor/clarity-redo-line" style="fill: currentColor;"/>
            </button>
        </div>
        <editor-content :editor="editor" />
        <input type="hidden" :name="name" :value="formValue" />
    </div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-2'
import StarterKit from '@tiptap/starter-kit'

export default {
  components: {
    EditorContent,
  },

  props: {
    value: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    }
  },

  data() {
    return {
      editor: null,
      formValue: null,
    }
  },

  mounted() {
    this.editor = new Editor({
      content: this.value,
      extensions: [
          StarterKit.configure({
            heading: {
            levels: [1, 2, 3],
            },
          }),
      ],
      onUpdate: () => {
        this.formValue = this.editor.getHTML()
      },
    })
    this.formValue = this.editor.getHTML()
  },

  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>