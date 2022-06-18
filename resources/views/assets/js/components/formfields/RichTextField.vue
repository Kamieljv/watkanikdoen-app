<template>
    <div class="rich-text-editor rounded-md mt-1 p-1 border">
        <div v-if="editor" class="menu flex flex-row space-x-1 pb-2 border-b">
            <button :disabled="disabled" @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }" tabindex="-1">
                <svg-vue icon="editor/clarity-bold-line" style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }" tabindex="-1">
                <svg-vue icon="editor/clarity-italic-line" style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'is-active': editor.isActive('underline') }" tabindex="-1">
                <svg-vue icon="editor/clarity-underline-line" style="fill: currentColor;"/>
            </button>
            <span class="divider" />
            <button :disabled="disabled" @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }" tabindex="-1">
                p
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }" tabindex="-1">
                H1
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }" tabindex="-1">
                H2
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }" tabindex="-1">
                H3
            </button>
            <span class="divider" />
            <button :disabled="disabled" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }" tabindex="-1">
                <svg-vue icon="editor/clarity-bullet-list-line" style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }" tabindex="-1">
                <svg-vue icon="editor/clarity-number-list-line" style="fill: currentColor;"/>
            </button>
            <span class="divider" />
            <!-- <button :disabled="disabled" @click="editor.chain().focus().toggleLink().run()" :class="{ 'is-active': editor.isActive('link') }">
                <svg-vue icon="editor/clarity-link-line" style="fill: currentColor;"/>
            </button> -->
            <!-- <span class="divider" /> -->
            <button :disabled="disabled" @click="editor.chain().focus().undo().run()" tabindex="-1">
                <svg-vue icon="editor/clarity-undo-line" style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().redo().run()" tabindex="-1">
                <svg-vue icon="editor/clarity-redo-line" style="fill: currentColor;"/>
            </button>
        </div>
        <editor-content :editor="editor" />
        <input type="hidden" :name="name" :value="formValue" />
    </div>
</template>

<script>
import { Editor, EditorContent } from "@tiptap/vue-2"
import StarterKit from "@tiptap/starter-kit"
import Underline from "@tiptap/extension-underline"
import CharacterCount from '@tiptap/extension-character-count'
// import Link from '@tiptap/extension-link'

export default {
	components: {
		EditorContent,
	},

	props: {
		value: {
			type: String,
			default: "",
		},
		name: {
			type: String,
			default: "",
		},
		disabled: {
			type: Boolean,
			default: false,
		},
        maxCharacters: {
            type: Number,
            default: 16000
        }
	},

	data() {
		return {
			editor: null,
			formValue: null,
		}
	},
    watch: {
        formValue: function(value) {
            this.$emit('input', value)
        },
        value: function() {
            this.formValue = this.value
        }
    },
	mounted() {
        const limit = this.maxCharacters
		this.editor = new Editor({
			content: this.value,
			extensions: [
				StarterKit.configure({
					heading: {
						levels: [1, 2, 3],
					},
				}),
				Underline,
                CharacterCount.configure({
                    limit,
                }),
				// Link,
			],
			editable: !this.disabled,
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