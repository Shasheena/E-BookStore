<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Sign in</title>
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="row">
        <div class="col-12 mt-3">
            <div class="card" style="width: 1000px;" id="invoice">
                <div class="card-body shadow">
                    <div class="row">
                        <div class="col-4 text-end">
                            <h1 class="fw-bold text-decoration-underline">Invoice No:</h1>
                        </div>
                        <div class="col-2 text-start mt-3">
                            <h4>#001</h4>
                        </div>
                        <div class="col-6 text-end mt-3">
                            <h3 class="fw-bold text-primary">sBooks</h3><br />
                            <label>Welmilla Junction,</label><br />
                            <label>Welmilla.</label>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 text-end">
                                    <h2 class="fw-bold">To:</h2>
                                </div>
                                <div class="col-7 text-start text-decoration-none mt-3">
                                    <label>line1,</label><br />
                                    <label>line2.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-7 text-end">
                                    <h4 class="fw-bold">shasheenanethmini2@gmail.com</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-primary">
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Cover</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Unit Prize</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">dhdgdg</th>
                                        <td>sgsggdhdh</td>
                                        <td>gdgdd</td>
                                        <td>1</td>
                                        <td>500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-9 text-start bg-info bg-opacity-25">
                                    <td>Dilevery fee:</td><br /><br />
                                    <td>Shipping:</td><br /><br />
                                    <td>Discount</td><br /><br />
                                    <td>Total</td>
                                </div>
                                <div class="col-3 text-start bg-light">
                                    <td>200</td><br /><br />
                                    <td>100</td><br /><br />
                                    <td>10%</td><br /><br />
                                    <label class="fs-6 text-bg-danger text-white">630</label>
                                </div>
                            </div>

                        </div>
                        <hr />
                        <div class="text-center">Thank you!</div>
                        <div class="col-12 text-end mt-5">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <label>sBooks</label><br />
                                    <label>All rights reserved&copy;</label>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="window" download="window" class="fs-4"><i class="bi bi-filetype-pdf"></i></a>
                                    <button class="btn btn-link fs-4" onclick="printInvoice();"><i class="bi bi-printer-fill"></i></button><br />
                                    <label><i class="bi bi-telephone-fill"></i>&nbsp;0774564566</label><br/>
                                    <label>Date:</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12"></div>
        </div>
       
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>