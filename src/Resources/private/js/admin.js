// import {displayUploadedDocument, initCanvas} from "./preview-document-pdf";
import './sylius-move-document-types';

document.addEventListener('DOMContentLoaded', () => {
  $('.asdoria-update-document-types').moveDocumentTypes($('.asdoria-document-type-position'));
  // preview PDF
  // const canvas = document.querySelectorAll('canvas');
  // if (canvas) {
  //   canvas.forEach((ele) => initCanvas(ele));
  // }
  // document.querySelectorAll("input[type*='file'][name*='productDocument']").forEach((e) => {
  //   e.addEventListener('change', ({currentTarget}) => displayUploadedDocument(currentTarget))
  // })
});
