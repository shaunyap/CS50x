<div class="row">
<div class="col-sm-12 col-md-6 col-md-offset-3">
    <h1>Sell Shares</h1>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-8 col-md-offset-2">
    <form action="sell.php" method="post">
    <table class="table">
          <thead>
            <tr>
              <th>Sell?</th>
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
                print("<td><input type='checkbox' name='" . $position["symbol"] . "'</td>");
                print("<td>" . $position["name"] . "</td>");
                print("<td>" . $position["symbol"] . "</td>");
                print("<td>" . $position["shares"] . "</td>");
                print("<td>$ " . $position["price"] . "</td>");
                print("<td>$ " . $position["total"] . "</td>");
                print("<td>
                        </td>");
                print("</tr>");
            }
        ?>
    </table>
        <button class='btn btn-primary btn-block btn-lg' type='submit'>
            Sell
        </button>
    </form>
</div>
</div>
