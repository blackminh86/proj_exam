    <div class="row">
        <div class="col col-sm-6 col-md-2">
            <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active"> <a data-toggle="tab" href="#grid-container" name="option_display"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                    <li class=""><a data-toggle="tab" href="#list-container" name="option_display"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
            </div>
            <!-- /.filter-tabs -->
        </div>
        <!-- /.col -->
        <div class="col col-sm-12 col-md-6">
            <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                    <div class="fld inline">
                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle" id="filter-position"> Position <span class="caret"></span> </button>
                            <ul role="menu" class="dropdown-menu">
                                <li role="presentation"><a href="javascript:location.reload()">-- Clear --</a></li>
                                <li role="presentation"><a href="javascript:changeOrdering('asc')">Price:Lowest first</a></li>
                                <li role="presentation"><a href="javascript:changeOrdering('desc')">Price:Highest first</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.fld -->
                </div>
                <!-- /.lbl-cnt -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.col -->
        <div class="col col-sm-6 col-md-4 text-right">
            @include('default.block.pagination')
            <!-- /.pagination-container -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->