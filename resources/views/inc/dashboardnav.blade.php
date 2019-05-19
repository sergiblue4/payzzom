<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/dashboard/">
            <img src="https://superpay.it/static/assets/img/high_res_logo_no_bg.png" class="navbar-brand-img
            mx-auto" alt="SuperPay Logo">
        </a>

        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}" role="button" aria-controls="sidebarDashboards">
                        <i class="fe fe-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/payment-link/" role="button">
                        <i class=" fe fe-link "></i> Payment links
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/recurring-payment/" role="button">
                        <i class=" fe fe-refresh-cw "></i> Recuring payments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/charges/" role="button">
                        <i class="fe fe-file"></i> View all payments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/balance/" role="button" aria-controls="sidebarDashboards">
                        <i class="fe fe-credit-card"></i> Balance
                    </a>
                </li>
            </ul>
            <hr class="navbar-divider my-3">
            <h6 class="navbar-heading">Admin Section</h6>

            <ul class="navbar-nav mb-md-4">
                <li class="nav-item">
                    <a class="nav-link " href="/dashboard/edit/">
                        <i class="fe fe-clipboard"></i> Company Details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/team/manage">
                        <i class="fe fe-users"></i> Edit Team
                    </a>
                </li>
            </ul>

            <div class="mt-auto"></div>

            <div class="navbar-user d-none d-md-flex" id="sidebarUser">
                <div class="dropup">
                    <a href="#" class="navbar-user-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h5>Powered by SuperPay</h5>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                        <a href="https://superpay.it" class="dropdown-item">Visit home page</a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</nav>
