<?php



include('header.php');







//============== check permission =================================



if (!($AUR == '1')) {



    ob_clean();



    header("Location: index.php?noaccess");



}

?>

<script type="text/javascript">

    function submit_fjs()

    {

        document.forms["select_cons_date"].submit();



    }



</script> 

    <section class="container-fluid" id="main_body">

        <div id="contents">

            <h2 style="margin-bottom: 0px;">Accounts Ledger</h2>

               <form id="select_cons_date" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" accept-charset="utf-8" class="form-horizontal">            



                <div class="control-group">

                    <label class="control-label" style="text-align: left; width: 120px;" for="ddl_consignment_year">Search Year:</label>

                    <div class="controls" style="margin-left: 80px;">

                        <select id="ddl_consignment_year" name="ddl_consignment_year" tabindex="6" class="span2">

                            <!--the set_select will reload the entered value, as a default value it will pick from the $data passed if it is available -->



                                <option value="all" onclick="javascript: submit_fjs();">All</option>

                                    <?php

                                    /*$a = "SELECT * FROM tbl_customer_consigment";

                                    $result = mysql_query($a);

                                    while ($row = mysql_fetch_array($result)) {*/

                                        ?>



                                <option value= "2020 " onclick="javascript: submit_fjs();">2020 </option>

                                <option value= "2021 " onclick="javascript: submit_fjs();">2021 </option>

                                <option value= "2022 " onclick="javascript: submit_fjs();">2022 </option>

                                <option value= "2023 " onclick="javascript: submit_fjs();">2023 </option>

                            </select>

                        <span> <input type="submit" name="change" value="Change" style="background: transparent; border: transparent; text-decoration: underline; color: blue;  "></span>



                    </div>

                </div>

            </form>  

            

            <form action="" method="get" id="select-month" class="form-horizontal">

             <div class="control-group">

                <label class="control-label" style="text-align: left; width: 120px;" for="select-month">Search Month:</label>

                  <div class="controls" style="margin-left: 80px;">

                    <select name="month">

                        <option value="01" <?php if($_GET['month'] == '01'): ?> selected <?php endif; ?>>1</option>

                        <option value="02" <?php if($_GET['month'] == '02'): ?> selected <?php endif; ?>>2</option>

                        <option value="03" <?php if($_GET['month'] == '03'): ?> selected <?php endif; ?>>3</option>

                        <option value="04" <?php if($_GET['month'] == '04'): ?> selected <?php endif; ?>>4</option>

                        <option value="05" <?php if($_GET['month'] == '05'): ?> selected <?php endif; ?>>5</option>

                        <option value="06" <?php if($_GET['month'] == '06'): ?> selected <?php endif; ?>>6</option>

                        <option value="07" <?php if($_GET['month'] == '07'): ?> selected <?php endif; ?>>7</option>

                        <option value="08" <?php if($_GET['month'] == '08'): ?> selected <?php endif; ?>>8</option>

                        <option value="09" <?php if($_GET['month'] == '09'): ?> selected <?php endif; ?>>9</option>

                        <option value="10" <?php if($_GET['month'] == '10'): ?> selected <?php endif; ?>>10</option>

                        <option value="11" <?php if($_GET['month'] == '11'): ?> selected <?php endif; ?>>11</option>

                        <option value="12" <?php if($_GET['month'] == '12'): ?> selected <?php endif; ?>>12</option>

                    </select>

                    <input type="submit" value="change" style="background: transparent; border: transparent; text-decoration: underline; color: blue;  "> <a href="ledgerprint.php" class="btn print" target="_blank" style="height:22px;">Print Ledger</a>

                </div>

              </div>

            </form>

            </div>

            <div>

                <div style=

                "border: 1px dotted #CCCCCC ; padding: 20px 10px 10px 10px ;">

                    <table class=

                    "table table-bordered table-hover table-condensed" id=

                    "tbl_account_ledgers">

                        <thead>

                            <tr>

                                <th style=

                                "min-width: 30px; text-align: center;">

                                <span id="col_ledger_number">Bill #</span></th>

                                <th data-type="int" style=

                                "min-width: 65px; text-align: center;">

                                <span id="col_account_ledger_id">Customer Name</span></th>

                                <th data-type="date" style=

                                "min-width: 60px; text-align: center;">

                                <span id="col_ledger_date">Customer NTN</span></th>

                                <th style=

                                "min-width: 80px; text-align: center;">

                                <span id="col_pay_to">Invoice Date</span></th>

                                <th style=

                                "min-width: 80px; text-align: center;">

                                <span id="col_pay_to">Quantity</span></th>

                                <th style=

                                "min-width: 130px; text-align: center;">

                                <span id="col_category">Service Charges</span></th>

                                <th style=

                                "min-width: 120px; text-align: center;">

                                <span id="col_remarks">Sales Tax</span></th>

                                

                                

                            </tr>

                        </thead>

                        <tbody>

                        <?php 

                        $i = 1;

                        if(isset($_GET['month'])){



                         $ddl_consignment_year = $_GET['month'];

                          $query = "SELECT i . *, c . * FROM  `tbl_invoice_taxes` i, tbl_customer_consigment c

                                    WHERE c.id = i.consignment_id and  MONTH(c.cons_date) = '$ddl_consignment_year'";

                       }else{



                        $query = "SELECT i . *, c . * FROM  `tbl_invoice_taxes` i, tbl_customer_consigment c

                                    WHERE c.id = i.consignment_id";

                       }

                        $res  = mysql_query( $query );

                        $num_rows = mysql_num_rows( $res );

                        

                        if ($num_rows > 0) {

                          

                        while( $key  = mysql_fetch_array( $res ) ) {

                            $cons_identity = $key["cons_identity"];

                            $customer_text = "SELECT *  FROM  `tbl_customer`

                                    WHERE id = '$cons_identity'";

                            $customer_query  = mysql_query( $customer_text );

                            while( $customer_data  = mysql_fetch_assoc( $customer_query ) ) {

                                    $customer_name = $customer_data['customer_name']; 

                                    $customer_ntn = $customer_data['customer_ntn']; 

                            }

                           $total_saletax = $key["cons_value_amount"]+$key["total"];

                           $con_id = $key["id"];

                           if( ( $con_id >= 1 || $con_id <= 9 ) && $con_id < 10){



                                $j = '0'.$con_id;

                            }else{

                                $j = $con_id;

                            }

                            if(!empty($key['cons_date'])){

                                $year = $key['cons_date'];



                            }else{

                                $year = date('Y-m-d');

                            } 

                            $con_date_final = $j . "-".date("y", strtotime($year));

                           echo

                            '<tr>

                            <td style="text-align: center">MCS-'.$con_date_final.'</td>

                                <td style="text-align: center;">'. $customer_name.'</td>

                                <td style="text-align: center;">'.$customer_ntn.'</td>

                                 <td style="text-align: center">'.$key["cons_date"].'</td>

                                  <td style="text-align: center">'.$key["cons_packages"].'</td>

                                <td style="text-align: center;">'.$key["service_charges"].'</td>

                                 <td style="text-align: center;">'.$key["sales_tx_amt"].'</td>

                               

                                

                            </tr>';

                            $i++;

                            } 

                          }else{

                            echo '<tr><td colspan="9">No Record Found</td></tr>';

                          }

                            ?>

                            <tr >

                            <td colspan="12" style="height: 20px;"></td>

                            </tr>

                            <tr>

                            <?php

                             if(isset($_GET['month'])){

        

                                 $ddl_consignment_year = $_GET['month'];

                                  $query = "SELECT i . *, c . * FROM  `tbl_invoice_taxes` i, tbl_customer_consigment c

                                            WHERE c.id = i.consignment_id and  MONTH(c.cons_date) = '$ddl_consignment_year'";

                               }else{

        

                                $query = "SELECT i . *, c . * FROM  `tbl_invoice_taxes` i, tbl_customer_consigment c

                                            WHERE c.id = i.consignment_id";

                               }

                            

                            $res  = mysql_query( $query );

                            

                            $num_rows = mysql_num_rows($res);

                            

                            if ($num_rows > 0) {

                               

                                while ($row = mysql_fetch_assoc($res))

                                    

                                    $data[] = $row;

                            //}

                            

                            ?>



                            <td colspan="5" style="text-align: center;">Total</td>

                            

                            <td style="text-align: center;"> <?php echo array_sum(array_column($data, 'service_charges')); ?> </td>

                            <td style="text-align: center;"> <?php echo array_sum(array_column($data, 'sales_tx_amt')); ?> </td>

                            

                            

                            <?php }else{ ?>

                            <!-- <td colspan="9"> No Record Found</td> -->

                            <?php } ?>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>











<!-- buffer space at the end -->



<div id="footer_buffer" style="margin-top: 40px;">&nbsp;</div>







<!-- only include the following HTML/JS if user has access to multiple projects under the current domain -->



<?php include_once 'footer.php'; ?>



</body>

<script type="text/javascript">

     var items = new Array();

     var itemCount = document.getElementsByClassName("blnce");

     var total = 0;

     var id= '';

     for(var i = 0; i < itemCount.length; i++)

     {

         id = "#p"+(i+1);

         total = total +  parseInt($(id).text());

     }

    document.getElementById('blnce').innerHTML = total;

</script>



</html>

