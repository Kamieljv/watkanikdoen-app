<template>
    <div class="rich-text-editor rounded-md mt-1 p-1 border">
        <div v-if="editor" class="menu flex flex-row space-x-1 pb-2 border-b">
            <button :disabled="disabled" @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }" tabindex="-1">
                <BoldIcon style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }" tabindex="-1">
                <ItalicIcon style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleUnderline().run()" :class="{ 'is-active': editor.isActive('underline') }" tabindex="-1">
                <UnderlineIcon style="fill: currentColor;"/>
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
                <UnorderdListIcon style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }" tabindex="-1">
                <OrderdListIcon style="fill: currentColor;"/>
            </button>
            <span class="divider" />
            <!-- <button :disabled="disabled" @click="editor.chain().focus().toggleLink().run()" :class="{ 'is-active': editor.isActive('link') }">
                <LinkIcon style="fill: currentColor;"/>
            </button> -->
            <!-- <span class="divider" /> -->
            <button :disabled="disabled" @click="editor.chain().focus().undo().run()" tabindex="-1">
                <UndoIcon style="fill: currentColor;"/>
            </button>
            <button :disabled="disabled" @click="editor.chain().focus().redo().run()" tabindex="-1">
                <RedoIcon style="fill: currentColor;"/>
            </button>
        </div>
        <editor-content :editor="editor" />
        <input type="hidden" :name="name" :value="formValue" />
    </div>
</template>

<script setup lang="ts">
import { Editor, EditorContent } from "@tiptap/vue-3"
import StarterKit from "@tiptap/starter-kit"
import Underline from "@tiptap/extension-underline"
import CharacterCount from '@tiptap/extension-character-count'
// import Link from '@tiptap/extension-link'

import { onBeforeUnmount, onMounted, ref, watch } from "vue"
import BoldIcon from '&/editor/clarity-bold-line.svg'
import ItalicIcon from '&/editor/clarity-italic-line.svg'
import UnderlineIcon from '&/editor/clarity-underline-line.svg'
import UnorderdListIcon from '&/editor/clarity-bullet-list-line.svg'
import OrderdListIcon from '&/editor/clarity-number-list-line.svg'
// import LinkIcon from '&/editor/clarity-link-line.svg'
import UndoIcon from '&/editor/clarity-undo-line.svg'
import RedoIcon from '&/editor/clarity-redo-line.svg'


const emit = defineEmits(['input'])

const props = defineProps({
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
})

const editor = ref(null)
const formValue = ref(null)

onMounted(() => {
    const limit = props.maxCharacters
    editor.value = new Editor({
        content: props.value,
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
        editable: !props.disabled,
        onUpdate: () => {
            formValue.value = editor.value.getHTML()
        },
    })
    formValue.value = editor.value.getHTML()
})

watch(formValue, (value) => {
    emit('input', value)
})

watch(() => props.value, (value) => {
    formValue.value = value
})

onBeforeUnmount(() => {
	editor.value.destroy()
})

</script>