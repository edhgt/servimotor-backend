import {
  Plugin,
  createDropdown,
  addListToDropdown,
  Command,
  Collection,
  ViewModel
} from 'ckeditor5';

class InsertVariableCommand extends Command {
  constructor(editor) {
    super(editor);
  }

  execute(value) {
    const model = this.editor.model;
    model.change(writer => {
      const insertPosition = model.document.selection.getFirstPosition();
      writer.insertText(value, insertPosition);
    });
  }

  refresh() {
    this.isEnabled = true;
  }
}

class VariablesPlugin extends Plugin {
  static get pluginName() {
    return 'VariablesPlugin';
  }

  init() {
    const editor = this.editor;

    editor.commands.add('insertVariable', new InsertVariableCommand(editor));

    editor.ui.componentFactory.add('variables', locale => {
      const dropdownView = createDropdown(locale);

      const variableOptions = [
        { label: 'Saludo', value: '{{ $documento->destinatario->saludo->name }}' },
        { label: 'Nombre', value: '{{ $documento->destinatario->name }}' },
        { label: 'Nombre y apellido', value: '{{ $documento->destinatario->primerNombrePrimerApellido }}' },
        { label: 'Cargo', value: '{{ $documento->destinatario->cargo->name }}' },
        { label: 'Dependencia', value: '{{ $documento->destinatario->dependencia->name }}' },
        { label: 'Entidad', value: '{{ $documento->destinatario->entidad->name }}' },
        { label: 'Asunto', value: '{{ $documento->asunto }}' },
        { label: 'Fecha de emisión de documento', value: '{{ $documento->fecha_emision }}' },
        { label: 'Correlativo', value: '{{ $documento->correlativo }}' },
        { label: 'Respuesta', value: '{!! $respuesta !!}' },
        { label: 'Tipo de documento', value: '{{ $documento->tipoDocumento->name }}' },
        { label: 'Usuario reservó', value: '{{ $documento->user->name }}' },
        { label: 'Iniciales Usuario reservó', value: '{{ $documento->user->initials }}' },
        { label: 'Nombre director', value: '{{ $documento->director->name }}' },
        { label: 'Iniciales director', value: '{{ $documento->director->initials }}' },
        { label: 'Número de página', value: '{PAGENO}' },
        { label: 'Total de páginas', value: '{nbpg}' },
      ];

      const items = new Collection();

      variableOptions.forEach(variable => {
        items.add({
          type: 'button',
          model: new ViewModel({
            label: variable.label,
            withText: true,
            commandParam: variable.value,
          }),
        });
      });

      dropdownView.on('execute', evt => {
        const value = evt.source.commandParam;
        console.log(evt.source)
        editor.editing.view.focus();
        if (value) {
          editor.execute('insertVariable', value);
          editor.editing.view.focus();
        }
      });

      addListToDropdown(dropdownView, items);


      dropdownView.buttonView.set({
        label: 'Variables',
        withText: true
      });

      return dropdownView;
    });
  }
}

export default VariablesPlugin;
