<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php if (isset($breadcrumb_name)) {echo $breadcrumb_name;} else{ echo 'Add Breadcrumb';} ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php if (isset($breadcrumb_link)) {echo $breadcrumb_link;} else{ echo 'Add Breadcrumb Link';} ?>"><?php if (isset($breadcrumb_item)) {echo $breadcrumb_item;} else{ echo 'Add Breadcrumb Item';} ?></a></li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>