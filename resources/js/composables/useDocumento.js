import { ref } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import { useToast } from 'vue-toastification'

export function useDocumentos() {
  const toast = useToast()

  const updateDocumento = (item, index, dataList, patch) => {
    if (dataList && typeof index === 'number') {
      dataList.splice(index, 1, {
        ...dataList[index],
        ...patch
      })
    } else {
      Object.assign(item, patch)
    }
  }

  const generar = async (item, index = null, dataList = null) => {
    const response = await axios.post(`/api/documentos/${item.id}/generar-pdf`);
    const fileUrl = response.data;

    updateDocumento(item, index, dataList, { file_url: '/' + fileUrl });

    const screenWidth = window.outerWidth;
    const screenHeight = window.outerHeight;

    const width = Math.floor(screenWidth * 0.6);
    const height = Math.floor(screenHeight * 0.8);

    const left = window.screenX + (screenWidth - width) / 2;
    const top = window.screenY + (screenHeight - height) / 2;

    const popup = window.open(
      '/' + fileUrl,
      '',
      `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`
    );

    if (!popup) {
      toast.error('No se pudo abrir la ventana. El navegador podría estar bloqueando popups.');
    }
  };



  const archivar = async (item, index = null, dataList = null) => {
    const result = await Swal.fire({
      title: '¿Desea archivar el documento?',
      text: `El documento ${item.correlativo} ya no podrá ser modificado.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, archivar'
    })

    if (result.isConfirmed) {
      await axios.put(`/api/documentos/${item.id}/archivar`)

      await Swal.fire('Archivado', 'El documento fue archivado', 'success')

      updateDocumento(item, index, dataList, {
        estado: 'Archivado',
        estado_documento_id: 3
      })
    }
  }

  const eliminar = async (item, index = null, dataList = null) => {
    const result = await Swal.fire({
      title: '¿Está seguro de eliminar un documento?',
      text: `El documento ${item.correlativo} no podrá ser modificado`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, eliminar',
    })

    if (result.isConfirmed) {
      await axios.delete(`/api/documentos/${item.id}`)

      await Swal.fire('Eliminado', 'El documento fue eliminado', 'success')

      const deletedPatch = {
        estado_documento_id: 4,
        deleted_at: new Date().toDateString()
      }

      updateDocumento(item, index, dataList, deletedPatch)
    }
  }

  return {
    generar,
    archivar,
    eliminar
  }
}
