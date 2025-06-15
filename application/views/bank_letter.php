<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 50px 50px 100px 50 px;
            }

            header {
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
                height: 250px;

                /** Extra personal styles **/
              
                text-align: right;
               
            }

            footer {
                position: fixed; 
                bottom: -60; 
                left: 0px; 
                right: 0px;
                height: 250px; 

                /** Extra personal styles **/
               
            }

            body {
                margin-top: 4cm;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="<?php echo base_url();?>../gst_invoice/uploads/logo/<?php echo $companyDetails->company_logo;?>" style="height: 150px;"  height="150px"/>
        </header>

        <footer>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <th colspan="2" style="width:66%; text-align: left;"><?php echo $companyDetails->company_name;?></th>
                        <td style="width:33%;"></td>
                    </tr>
                    <tr>
                        <td style="width:33%;">
                            <h3>Head Office:</h3>
                            <p>
                                Office No.310,<br/>
                                Pride Purple Square, <br/>
                                Above SBI Bank,<br/>
                                Kalewadi Phata, <br/>
                                Pune-411057<br/>
                            </p>
                            
                        </td>
                        <td style="width:33%;">
                            <h3>Registered Office:</h3>
                            <p>
                                <?php echo preg_replace("/,/", "<br>", $companyDetails->address);?>
                                <br/>
                                <?php echo $city->city_name;?>-<?php echo $companyDetails->pin_code;?><br/>
                            </p>
                        </td>
                        <td style="width:33%;">
                            Website: www.gstindia.net.in<br/>
                            Email: ashish@sezindia.co.in<br/>
                            Tel.: 020-67916565, 022-40042384 <br/>
                            CIN No. U93090MH2009PTCJ94859<br/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main >
            
               <p>
                Date: <?php echo date('d/m/Y');?>
               </p>
               <p>
                    To,<br/>
                    The Manager, <br/>
                    Bank of Baroda,<br/>
                    Kalewadi Branch,<br/>
                    Pune
                </p>
                <p>
                    Sub. : Request to Proceed NEFT
                </p>
                <p>
                    Dear Sir,<br/>
                    We have banking relationship with you in the name of <?php echo $companyDetails->company_name; ?> bearing
                    saving a/c no. <?php echo $companyDetails->account_no; ?>.<br/>
                    We are requested to initiate the salary of our Employees and debit the charges if any.
                </p>
                <p style="font-weight: bold;">Thanking You.</p>
                <p style="font-weight: bold;">For <?php echo $companyDetails->company_name;?></p>
                <br/>
                <br/>
                <br/>
                <p style="font-weight: bold;">
                    Authorized Signatory<br/>
                    <?php echo $companyDetails->comp_ceo;?>
                </p>
                 <p>
                    Encl: 1. Cheque for Yourself <br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          2. Employee Bank Details Sheet <br/>
                </p>
            
            
        </main>
    </body>
</html>