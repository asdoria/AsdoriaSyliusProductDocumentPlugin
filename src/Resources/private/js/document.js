// import * as PDFJS from 'pdfjs-dist/build/pdf';
import * as PDFJS from "pdfjs-dist/webpack";
/**
 *
 * @param input
 */
export const displayUploadedDocument = (input) => {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function ({target}) {
            displayUploaded(input, target)
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/**
 *
 * @param input
 * @param result
 */
const displayUploaded = (input, {result}) => {
  const document = PDFJS.getDocument(result);
  document.promise.then(function getPdf(pdf) {
        pdf.getPage(1).then(function getPage(page) {
            processCanvas(
                findOrCreatedCanvas(input),
                page
            );
        });
    });
}

/**
 *
 * @param input
 * @returns {Element}
 */
const findOrCreatedCanvas = (input) => {
    let canvas = getCanvas(input) ;
    if (!canvas) {
        canvas = createdCanvasElement();
        getParent(input).parentElement.prepend(canvas);
    }

    return canvas;
}

const createdCanvasElement = () => {
    const canvasElement = document.createElement('canvas');
    canvasElement.id = 'document';
    canvasElement.classList.add('ui', 'small', 'bordered', 'image');
    canvasElement.style.display = 'block';

    return canvasElement;
}
/**
 *
 * @param input
 * @returns {Element}
 */
const getCanvas = (input) => {
    return getParent(input).parentElement.querySelector('canvas')
}


/**
 *
 * @param input
 * @returns {HTMLElement}
 */
const getParent = ({parentElement}) => {
    return parentElement
}
/**
 *
 * @param canvas
 */
export const initCanvas = (canvas) => {
    const {path} = canvas.dataset;
    if (!path) {
        return ;
    }

    fetch(path)
        .then((response) => response.blob())
        .then((blob) => {
            const base64 = URL.createObjectURL(blob)
            const loadingTask = PDFJS.getDocument(base64)
            loadingTask.promise.then(function getDocument(doc) {
                doc.getPage(1).then(function getPage(page) {
                    processCanvas(canvas, page)
                });
            });
        });
}

/**
 *
 * @param canvas
 * @param page
 */
const processCanvas = (canvas, page) =>{
    canvas.height = 100;
    canvas.width  = 100;
    page.render({
        canvasContext: canvas.getContext('2d'),
        viewport: page.getViewport(0.5)
    });
}
