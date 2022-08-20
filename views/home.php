<!DOCTYPE html>
<html lang="en">
<head>
  <title>PMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
 
    // DataTable
    var table = $('#example').DataTable({
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });
});
  </script>

</head>
<body class="col-md-12">
    <div class="well">
        <h1>Property Management System</h1>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Country</th>
                <th>Town</th>
                <th>Property Type</th>
                <th>Image</th>
                <th>Price</th>
                <th>No. of Bedrooms</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $d){
                ?>
                <tr>
                    <td><?php echo $d->country?></td>
                    <td><?php echo $d->town?></td>
                    <td><?php echo $d->title?></td>
                    <td><?php echo $d->thumbnail?></td>
                    <td><?php echo $d->price?></td>
                    <td><?php echo $d->num_bedrooms?></td>
                </tr>
                <?php
            }
            ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Country</th>
                <th>Town</th>
                <th>Property Type</th>
                <th>Image</th>
                <th>Price</th>
                <th>No. of Bedrooms</th>
            </tr>
        </tfoot>
</table>
</div>
</body>
</html>
