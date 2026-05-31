import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import Underline from '@tiptap/extension-underline'
import Placeholder from '@tiptap/extension-placeholder'
import TextAlign from '@tiptap/extension-text-align'
import Highlight from '@tiptap/extension-highlight'
import Image from '@tiptap/extension-image'

function initEditor(contentTextareaId) {
    const textarea = document.getElementById(contentTextareaId)
    if (!textarea) return

    const wrapper = document.createElement('div')
    wrapper.className = 'tiptap-wrapper'
    textarea.parentNode.insertBefore(wrapper, textarea)
    textarea.style.display = 'none'

    // Toolbar HTML
    wrapper.innerHTML = `
    <div class="tiptap-toolbar" id="toolbar-${contentTextareaId}">
        <div class="tiptap-toolbar-group">
            <select class="tiptap-select" data-action="heading">
                <option value="0">Paragraph</option>
                <option value="1">Heading 1</option>
                <option value="2">Heading 2</option>
                <option value="3">Heading 3</option>
            </select>
        </div>
        <div class="tiptap-toolbar-divider"></div>
        <div class="tiptap-toolbar-group">
            <button type="button" class="tiptap-btn" data-action="bold" title="Bold (Ctrl+B)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 15.5H10V12.5H13.5C14.33 12.5 15 13.17 15 14C15 14.83 14.33 15.5 13.5 15.5ZM10 6.5H13C13.83 6.5 14.5 7.17 14.5 8C14.5 8.83 13.83 9.5 13 9.5H10V6.5ZM15.6 10.79C16.57 10.12 17.25 9.04 17.25 8C17.25 5.74 15.5 4 13.25 4H7V18H14.04C16.14 18 17.75 16.3 17.75 14.21C17.75 12.69 16.89 11.39 15.6 10.79Z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="italic" title="Italic (Ctrl+I)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M10 4V7H12.21L8.79 15H6V18H14V15H11.79L15.21 7H18V4H10Z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="underline" title="Underline (Ctrl+U)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17C15.31 17 18 14.31 18 11V3H15.5V11C15.5 12.93 13.93 14.5 12 14.5C10.07 14.5 8.5 12.93 8.5 11V3H6V11C6 14.31 8.69 17 12 17ZM5 19V21H19V19H5Z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="strike" title="Strikethrough">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6.85 7.08C6.85 4.37 9.45 3 12.24 3C13.64 3 14.96 3.36 15.98 4C17 4.64 17.76 5.67 17.76 7.08C17.76 7.45 17.7 7.82 17.58 8.15H14.8C14.87 7.95 14.9 7.77 14.9 7.61C14.9 6.65 14.06 5.95 12.24 5.95C10.5 5.95 9.6 6.61 9.6 7.61C9.6 8.01 9.78 8.35 10.13 8.65H6.73C6.75 8.12 6.85 7.6 6.85 7.08ZM21 12V14H13.27L13.85 14.29C14.93 14.82 15.77 15.42 15.77 16.69C15.77 18.37 14.38 20 11.43 20C8.18 20 6.4 18.22 6.4 16H9.18C9.18 17.16 10.04 17.87 11.43 17.87C12.64 17.87 13.21 17.32 13.21 16.62C13.21 15.6 12.27 15.18 10.71 14.43L10 14H3V12H21Z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="highlight" title="Highlight">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M15.243 5.377l3.38 3.38-9.192 9.498-4.471.593.593-4.471 9.69-9.0zm5.378.323L18.3 3.379a1.5 1.5 0 00-2.122 0l-1.378 1.378 3.38 3.38 2.44-2.44a1.5 1.5 0 000-2.122zM3 17.25V21h3.75l8.07-8.07-3.75-3.75L3 17.25z"/></svg>
            </button>
        </div>
        <div class="tiptap-toolbar-divider"></div>
        <div class="tiptap-toolbar-group">
            <button type="button" class="tiptap-btn" data-action="h2" title="Heading 2">H2</button>
            <button type="button" class="tiptap-btn" data-action="h3" title="Heading 3">H3</button>
        </div>
        <div class="tiptap-toolbar-divider"></div>
        <div class="tiptap-toolbar-group">
            <button type="button" class="tiptap-btn" data-action="bulletList" title="Bullet List">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="orderedList" title="Numbered List">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="blockquote" title="Blockquote">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="codeBlock" title="Code Block">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>
            </button>
        </div>
        <div class="tiptap-toolbar-divider"></div>
        <div class="tiptap-toolbar-group">
            <button type="button" class="tiptap-btn" data-action="link" title="Insert Link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="unlink" title="Remove Link">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17 7h-4v2h4c1.65 0 3 1.35 3 3s-1.35 3-3 3h-4v2h4c2.76 0 5-2.24 5-5s-2.24-5-5-5zm-6 8H7c-1.65 0-3-1.35-3-3s1.35-3 3-3h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-2zm-3-4h8v2H8v-2zm7.08-6.49l-1.41-1.41-3.54 3.54 1.41 1.41 3.54-3.54zm-9.9 9.9l1.41 1.41 3.54-3.54-1.41-1.41-3.54 3.54z"/></svg>
            </button>
        </div>
        <div class="tiptap-toolbar-divider"></div>
        <div class="tiptap-toolbar-group">
            <button type="button" class="tiptap-btn" data-action="alignLeft" title="Align Left">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M15 15H3v2h12v-2zm0-8H3v2h12V7zM3 13h18v-2H3v2zm0 8h18v-2H3v2zM3 3v2h18V3H3z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="alignCenter" title="Align Center">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M7 15v2h10v-2H7zm-4 6h18v-2H3v2zm0-8h18v-2H3v2zm4-6v2h10V7H7zM3 3v2h18V3H3z"/></svg>
            </button>
        </div>
        <div class="tiptap-toolbar-divider tiptap-toolbar-spacer"></div>
        <div class="tiptap-toolbar-group">
            <button type="button" class="tiptap-btn" data-action="undo" title="Undo (Ctrl+Z)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12.5 8c-2.65 0-5.05.99-6.9 2.6L2 7v9h9l-3.62-3.62c1.39-1.16 3.16-1.88 5.12-1.88 3.54 0 6.55 2.31 7.6 5.5l2.37-.78C21.08 11.03 17.15 8 12.5 8z"/></svg>
            </button>
            <button type="button" class="tiptap-btn" data-action="redo" title="Redo (Ctrl+Y)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.4 10.6C16.55 8.99 14.15 8 11.5 8c-4.65 0-8.58 3.03-9.96 7.22L3.9 16c1.05-3.19 4.05-5.5 7.6-5.5 1.95 0 3.73.72 5.12 1.88L13 16h9V7l-3.6 3.6z"/></svg>
            </button>
        </div>
    </div>
    <div id="tiptap-editor-${contentTextareaId}" class="tiptap-content"></div>
    `

    const editorEl = wrapper.querySelector(`#tiptap-editor-${contentTextareaId}`)
    const toolbar = wrapper.querySelector(`#toolbar-${contentTextareaId}`)

    const editor = new Editor({
        element: editorEl,
        extensions: [
            StarterKit.configure({ heading: { levels: [1, 2, 3] } }),
            Underline,
            Highlight,
            Image,
            Link.configure({ openOnClick: false, HTMLAttributes: { class: 'tiptap-link' } }),
            Placeholder.configure({ placeholder: 'Start writing your post...' }),
            TextAlign.configure({ types: ['heading', 'paragraph'] }),
        ],
        content: textarea.value,
        onUpdate({ editor }) {
            textarea.value = editor.getHTML()
        },
        editorProps: {
            attributes: { class: 'tiptap-editor-body' }
        }
    })

    // Toolbar actions
    toolbar.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-action]')
        if (!btn) return
        const action = btn.dataset.action
        switch (action) {
            case 'bold':          editor.chain().focus().toggleBold().run(); break
            case 'italic':        editor.chain().focus().toggleItalic().run(); break
            case 'underline':     editor.chain().focus().toggleUnderline().run(); break
            case 'strike':        editor.chain().focus().toggleStrike().run(); break
            case 'highlight':     editor.chain().focus().toggleHighlight().run(); break
            case 'h2':            editor.chain().focus().toggleHeading({ level: 2 }).run(); break
            case 'h3':            editor.chain().focus().toggleHeading({ level: 3 }).run(); break
            case 'bulletList':    editor.chain().focus().toggleBulletList().run(); break
            case 'orderedList':   editor.chain().focus().toggleOrderedList().run(); break
            case 'blockquote':    editor.chain().focus().toggleBlockquote().run(); break
            case 'codeBlock':     editor.chain().focus().toggleCodeBlock().run(); break
            case 'alignLeft':     editor.chain().focus().setTextAlign('left').run(); break
            case 'alignCenter':   editor.chain().focus().setTextAlign('center').run(); break
            case 'undo':          editor.chain().focus().undo().run(); break
            case 'redo':          editor.chain().focus().redo().run(); break
            case 'link': {
                const url = window.prompt('Enter URL:', editor.getAttributes('link').href || 'https://')
                if (url) editor.chain().focus().setLink({ href: url }).run()
                break
            }
            case 'unlink':        editor.chain().focus().unsetLink().run(); break
        }
    })

    // Update active states
    editor.on('selectionUpdate', () => updateToolbarState(editor, toolbar))
    editor.on('transaction', () => updateToolbarState(editor, toolbar))

    return editor
}

function updateToolbarState(editor, toolbar) {
    const states = {
        bold: editor.isActive('bold'),
        italic: editor.isActive('italic'),
        underline: editor.isActive('underline'),
        strike: editor.isActive('strike'),
        highlight: editor.isActive('highlight'),
        h2: editor.isActive('heading', { level: 2 }),
        h3: editor.isActive('heading', { level: 3 }),
        bulletList: editor.isActive('bulletList'),
        orderedList: editor.isActive('orderedList'),
        blockquote: editor.isActive('blockquote'),
        codeBlock: editor.isActive('codeBlock'),
        link: editor.isActive('link'),
        alignLeft: editor.isActive({ textAlign: 'left' }),
        alignCenter: editor.isActive({ textAlign: 'center' }),
    }
    toolbar.querySelectorAll('[data-action]').forEach(btn => {
        const a = btn.dataset.action
        btn.classList.toggle('is-active', !!states[a])
    })
}

window.initEditor = initEditor
