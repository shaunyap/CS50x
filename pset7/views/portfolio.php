<div class="row">
<div class="col-sm-12 col-md-8 col-md-offset-2">
    <h1>Portfolio</h1>
    <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Symbol</th>
              <th>Quantity</th>
              <th>Current Price</th>
              <th>Total</th>
            </tr>
          </thead>
        <?php
    
            foreach ($positions as $position)
            {
                print("<tr>");
                print("<td>" . $position["name"] . "</td>");
                print("<td>" . $position["symbol"] . "</td>");
                print("<td>" . $position["shares"] . "</td>");
                print("<td>$ " . $position["price"] . "</td>");
                print("<td>$ " . $position["total"] . "</td>");
                print("</tr>");
            }

                print("<tr>");
                print("<td></td><td></td><td></td><td></td><td>$" . $grandTotal . "</td>");            
                print("</tr>");
        ?>
    </table>
</div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3>Your balance is $<?= $balance ?></h3>
    </div>
</div>
