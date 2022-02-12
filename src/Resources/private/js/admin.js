import {displayUploadedDocument, initCanvas} from "./document";

document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.querySelectorAll('canvas');
  if (canvas) {
    canvas.forEach((ele) => initCanvas(ele));
  }
  document.querySelectorAll("input[type*='file'][name*='productDocument']").forEach((e) => {
    e.addEventListener('change', ({currentTarget}) => displayUploadedDocument(currentTarget))
  })
});
//asdoriasyliusproductdocumentplugin
