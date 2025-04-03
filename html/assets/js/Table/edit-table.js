$(document).ready(function() {
  const $tableID = $('#edit-table');
  
  const newTr = `
  <tr>
    <td contenteditable="true">Example</td>
    <td contenteditable="true">Example</td>
    <td contenteditable="true">Example</td>
    <td contenteditable="true">Example</td>
    <td contenteditable="true">Example</td>
    <td>
      <span class="table-up"><a href="#!" class="indigo-text"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span>
      <span class="table-down"><a href="#!" class="indigo-text"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a></span>
    </td>
    <td>
      <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
    </td>
  </tr>`;

  // Add new row
  $('.table-add button').on('click', () => {
    const $clone = $($tableID.find('tbody tr').last().clone(true));
    $tableID.find('tbody').append($clone);
  });

  // Remove row
  $tableID.on('click', '.table-remove', function () {
    $(this).closest('tr').remove();
  });

  // Move row up
  $tableID.on('click', '.table-up', function () {
    const $row = $(this).closest('tr');
    if ($row.index() !== 0) {
      $row.prev().before($row);
    }
  });

  // Move row down
  $tableID.on('click', '.table-down', function () {
    const $row = $(this).closest('tr');
    $row.next().after($row);
  });
});
