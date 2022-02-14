import 'semantic-ui-css/components/api';
import $ from 'jquery';

$.fn.extend({
  moveDocumentTypes(positionInput) {
    const documentTypeRows = [];
    const element = this;

    element.api({
      method: 'PUT',
      beforeSend(settings) {
        /* eslint-disable-next-line no-param-reassign */
        settings.data = {
          documentTypes: documentTypeRows,
          _csrf_token: element.data('csrf-token'),
        };

        return settings;
      },
      onSuccess() {
        window.location.reload();
      },
    });

    positionInput.on('input', (event) => {
      const input = $(event.currentTarget);
      const documentTypeId = input.data('id');
      const row = documentTypeRows.find(({ id }) => id === documentTypeId);

      if (!row) {
        documentTypeRows.push({
          id: documentTypeId,
          position: input.val(),
        });
      } else {
        row.position = input.val();
      }
    });
  },
});
