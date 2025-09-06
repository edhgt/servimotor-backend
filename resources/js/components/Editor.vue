<template>
	<div class="main-container w-100">
		<div class="editor-container editor-container_document-editor" ref="editorContainerElement">
			<div class="editor-container__menu-bar" ref="editorMenuBarElement"></div>
			<div class="editor-container__toolbar" ref="editorToolbarElement"></div>
			<div class="editor-container__editor-wrapper w-100">
				<div class="editor-container__editor w-100">
					<div ref="editorElement">
						<ckeditor v-if="editor && config"
                            :editor="editor"
                            :config="config"
                            @ready="onReady"
                            @blur="onEditorChange"
                            v-model="editorData"
                        />
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
/**
 * This configuration was generated using the CKEditor 5 Builder. You can modify it anytime using this link:
 * https://ckeditor.com/ckeditor-5/builder/#installation/NoDgNARATAdAbDADBScCcB2NAWAjIjXAZgFYpso1co5FcSjFsLKjayQ3Ec45sUIAUwB2KImGC4wUxNLmIAupESIAJoNwAzNBAVA=
 */

import { computed, ref, onMounted, useTemplateRef, watch } from 'vue';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';

import {
	DecoupledEditor,
	Alignment,
	AutoLink,
	Autosave,
	BalloonToolbar,
	BlockQuote,
	Bold,
	Bookmark,
	Code,
	Essentials,
	FontBackgroundColor,
	FontColor,
	//FontFamily,
	FontSize,
	GeneralHtmlSupport,
	Heading,
	HorizontalLine,
	ImageEditing,
	ImageUtils,
	Indent,
	IndentBlock,
	Italic,
	Link,
	List,
	Paragraph,
	RemoveFormat,
	Strikethrough,
	Subscript,
	Superscript,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableLayout,
	TableProperties,
	TableToolbar,
	Underline
} from 'ckeditor5';

import VariablesPlugin from '../plugins/VariablesPlugin';

import 'ckeditor5/ckeditor5.css';

/**
 * Create a free account with a trial: https://portal.ckeditor.com/checkout?plan=free
 */
const LICENSE_KEY = 'GPL';

const editorToolbar = useTemplateRef('editorToolbarElement');
const editorMenuBar = useTemplateRef('editorMenuBarElement');

const isLayoutReady = ref(false);

const editor = DecoupledEditor;

const config = computed(() => {
	if (!isLayoutReady.value) {
		return null;
	}

	return {
		toolbar: {
			items: [
				'undo',
				'redo',
				'|',
				'heading',
				'|',
				'fontSize',
				//'fontFamily',
				'fontColor',
				'fontBackgroundColor',
				'|',
				'bold',
				'italic',
				'underline',
				'|',
				'link',
				'insertTable',
				'insertTableLayout',
				'blockQuote',
				'|',
				'alignment',
				'|',
				'bulletedList',
				'numberedList',
				'outdent',
				'indent',
                '|',
                'variables',
			],
			shouldNotGroupWhenFull: true
		},
		plugins: [
			Alignment,
			AutoLink,
			Autosave,
			BalloonToolbar,
			BlockQuote,
			Bold,
			Bookmark,
			Code,
			Essentials,
			FontBackgroundColor,
			FontColor,
			//FontFamily,
			FontSize,
			GeneralHtmlSupport,
			Heading,
			HorizontalLine,
			ImageEditing,
			ImageUtils,
			Indent,
			IndentBlock,
			Italic,
			Link,
			List,
			Paragraph,
			RemoveFormat,
			Strikethrough,
			Subscript,
			Superscript,
			Table,
			TableCaption,
			TableCellProperties,
			TableColumnResize,
			TableLayout,
			TableProperties,
			TableToolbar,
			Underline,
            VariablesPlugin
		],
		balloonToolbar: ['bold', 'italic', '|', 'link'],
		fontFamily: {
			supportAllValues: true
		},
		fontSize: {
			options: [10, 12, 14, 'default', 18, 20, 22],
			supportAllValues: true
		},
		heading: {
			options: [
				{
					model: 'paragraph',
					title: 'Paragraph',
					class: 'ck-heading_paragraph'
				},
				{
					model: 'heading1',
					view: 'h1',
					title: 'Heading 1',
					class: 'ck-heading_heading1'
				},
				{
					model: 'heading2',
					view: 'h2',
					title: 'Heading 2',
					class: 'ck-heading_heading2'
				},
				{
					model: 'heading3',
					view: 'h3',
					title: 'Heading 3',
					class: 'ck-heading_heading3'
				},
				{
					model: 'heading4',
					view: 'h4',
					title: 'Heading 4',
					class: 'ck-heading_heading4'
				},
				{
					model: 'heading5',
					view: 'h5',
					title: 'Heading 5',
					class: 'ck-heading_heading5'
				},
				{
					model: 'heading6',
					view: 'h6',
					title: 'Heading 6',
					class: 'ck-heading_heading6'
				}
			]
		},
		htmlSupport: {
			allow: [
				{
					name: /^.*$/,
					styles: true,
					attributes: true,
					classes: true
				}
			]
		},
		licenseKey: LICENSE_KEY,
		link: {
			addTargetToExternalLinks: true,
			defaultProtocol: 'https://',
			decorators: {
				toggleDownloadable: {
					mode: 'manual',
					label: 'Downloadable',
					attributes: {
						download: 'file'
					}
				}
			}
		},
		placeholder: 'Escriba o pegue su contendio aquí',
		table: {
			contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
		}
	};
});

const props = defineProps({
  modelValue: String | undefined
});

const editorData = ref(props.modelValue || '');

const emit = defineEmits(['update:modelValue']);

onMounted(() => {
	isLayoutReady.value = true;
});


watch(() => props.modelValue, (newVal) => {
	if (newVal !== editorData.value) {
		editorData.value = newVal || '';
	}
});

watch(editorData, (newVal) => {
	emit('update:modelValue', newVal);
});


function onReady(editor) {
	[...editorToolbar.value.children].forEach(child => child.remove());
	[...editorMenuBar.value.children].forEach(child => child.remove());

	editorToolbar.value.appendChild(editor.ui.view.toolbar.element);
	editorMenuBar.value.appendChild(editor.ui.view.menuBarView.element);
}

function onEditorChange() {
	emit('update:modelValue', editorData.value);
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap');

@media print {
	body {
		margin: 0 !important;
	}
}

.main-container {
	--ckeditor5-preview-height: 600px;
	font-family: 'Lato';
	width: fit-content;
	margin-left: auto;
	margin-right: auto;
}

.ck-content {
	font-family: 'Lato';
	line-height: 1.6;
	word-break: break-word;
}

.editor-container__editor-wrapper {
	display: flex;
	width: fit-content;
}

.editor-container_document-editor {
	border: 1px solid var(--ck-color-base-border);
}

.editor-container_document-editor .editor-container__toolbar {
	display: flex;
	position: relative;
	box-shadow: 0 2px 3px hsla(0, 0%, 0%, 0.078);
}

.editor-container_document-editor .editor-container__toolbar > .ck.ck-toolbar {
	flex-grow: 1;
	width: 0;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	border-top: 0;
	border-left: 0;
	border-right: 0;
}

.editor-container_document-editor .editor-container__menu-bar > .ck.ck-menu-bar {
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	border-top: 0;
	border-left: 0;
	border-right: 0;
}

.editor-container_document-editor .editor-container__editor-wrapper {
	max-height: var(--ckeditor5-preview-height);
	min-height: var(--ckeditor5-preview-height);
	overflow-y: scroll;
	background: var(--ck-color-base-foreground);
}

.editor-container_document-editor .editor-container__editor {
	margin-top: 28px;
	margin-bottom: 28px;
	height: 100%;
}

.editor-container_document-editor .editor-container__editor .ck.ck-editor__editable {
	box-sizing: border-box;
	/* min-width: calc(210mm + 2px);
	max-width: calc(210mm + 2px); */
	min-height: 297mm;
	height: fit-content;
	padding: 20mm 12mm;
	border: 1px hsl(0, 0%, 82.7%) solid;
	background: hsl(0, 0%, 100%);
	box-shadow: 0 2px 3px hsla(0, 0%, 0%, 0.078);
	flex: 1 1 auto;
	margin-left: 72px;
	margin-right: 72px;
}
</style>
