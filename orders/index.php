<?php

?>

<!-- ... (The styles and scripts remain the same) ... -->

<!-- ... (The styles and scripts remain the same) ... -->

<div class="container">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="row">
        <div class="col-sm-6">
          <h2>Manage <b>orders</b></h2>
        </div>
        <div class="col-sm-6">
          <a href="../users/productsindex.php" class="btn btn-success btn-add" data-toggle="modal"> <span>Add New Order</span></a>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>
            <span class="custom-checkbox">
              <input type="checkbox" id="selectAll">
              <label for="selectAll"></label>
            </span>
          </th>
          <th>id</th>
          <th>user_id</th>
          <th>total</th>
          <th>delivery_charges</th>
          <th>order_date_time</th>
          <th>status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'config.php';
        // read all rows from the database table
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);
        if (!$result) {
          die("invalid query:" . $conn->error);
        }
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>
                    <span class='custom-checkbox'>
                      <input type='checkbox' id='checkbox1'>
                      <label for='checkbox1'></label>
                    </span>
                  </td>
                  <td>$row[id]</td>
                  <td>$row[user_id]</td>
                  <td>$row[total]</td>
                  <td>$row[delivery_charges]</td>
                  <td>$row[order_date_time]</td>
                  <td>$row[status]</td>
                  <td>
                    <a class='btn btn-primary btn-sm btn-changestatus' href='changestatus.php?id=$row[id]'>change status</a>
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- ... (The existing style code remains the same) ... -->

</div>

<!-- ... (The existing modal code remains the same) ... -->

<script>
  $(document).ready(function () {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
      if (this.checked) {
        checkbox.each(function () {
          this.checked = true;
        });
      } else {
        checkbox.each(function () {
          this.checked = false;
        });
      }
    });
    checkbox.click(function () {
      if (!this.checked) {
        $("#selectAll").prop("checked", false);
      }
    });
  });
</script>

