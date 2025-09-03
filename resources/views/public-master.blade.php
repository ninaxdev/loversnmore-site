<!-- include header -->
@include('includes.header')
<!-- /include header -->
<body id="page-top" class="lw-page-bg lw-public-master" style="background-color: var(--lw-white); font-family: var(--lw-font-family);">
    <!-- Page Wrapper -->
    <div id="wrapper"  style="background-color: var(--lw-white);">
        <!-- include sidebar -->
        @if(isLoggedIn())
        @include('includes.public-sidebar')
        @endif
        <!-- /include sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column lw-page-bg" style="background-color: var(--lw-white);">
            <div id="content">
                <!-- include top bar -->
                @if(isLoggedIn())
                @include('includes.public-top-bar')
                @endif
                <!-- /include top bar -->
                <!-- header advertisement -->
                @if(!getFeatureSettings('no_adds') and getStoreSettings('header_advertisement')['status'] == 'true')
                <div class="lw-ad-block-h90 my-5 lw-ml-5">
                    <?= getStoreSettings('header_advertisement')['content'] ?>
                </div>
                @endif
                <!-- /header advertisement -->

                <!-- Begin Page Content -->
                <div class="lw-page-content" style="background-color: var(--lw-white); min-height: 100vh;">
                    @if(isset($pageRequested))
                    <?php echo $pageRequested; ?>
                    @endif
                   
                </div>
                <!-- /.container-fluid -->
                @if(!getFeatureSettings('no_adds') and getStoreSettings('footer_advertisement')['status'] == 'true')
                <div class="lw-ad-block-h90 my-5 lw-ml-5">
                    <?= getStoreSettings('footer_advertisement')['content'] ?>
                </div>
                @endif

            </div>
             <!-- footer advertisement -->
      
     <!-- /footer advertisement -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
     
    <!-- End of Page Wrapper -->

    <div class="lw-cookie-policy-container row p-4" id="lwCookiePolicyContainer">
        <div class="col-sm-11">
            @include('includes.cookie-policy')
        </div>
        <div class="col-sm-1 mt-2"><button id="lwCookiePolicyButton" class="btn btn-primary"><?= __tr('OK') ?></button></div>
    </div>
    <!-- include footer -->
    @include('includes.footer')
    <!-- /include footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="background: var(--lw-gradient-main); color: white; border-radius: var(--lw-radius-full); transition: var(--lw-transition);">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- /Scroll to Top Button-->

    <!-- Enhanced Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: var(--lw-white); border: none; border-radius: var(--lw-radius-lg); box-shadow: 0 20px 50px rgba(51, 25, 107, 0.15);">
                <div class="modal-header" style="background: var(--lw-gradient-main); color: white; border-radius: var(--lw-radius-lg) var(--lw-radius-lg) 0 0; border-bottom: none;">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-family: var(--lw-font-family); font-weight: 600;"><?= __tr('Ready to Leave?') ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: var(--lw-space-xl); font-family: var(--lw-font-family); color: var(--lw-primary);">
                    <?= __tr('Select "Logout" below if you are ready to end your current session.') ?>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--lw-gray-200); padding: var(--lw-space-lg);">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="background: var(--lw-gray-200); color: var(--lw-gray-700); border: none; border-radius: var(--lw-radius-lg); padding: 10px 20px; font-family: var(--lw-font-family); font-weight: 500;"><?= __tr('Not now') ?></button>
                    <a class="btn btn-primary" href="<?= route('user.logout') ?>" style="background: var(--lw-danger); border: none; border-radius: var(--lw-radius-lg); padding: 10px 20px; font-family: var(--lw-font-family); font-weight: 600; text-decoration: none;"><?= __tr('Logout') ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Logout Modal-->
</body>

<script>
    var response = jQuery.parseJSON('<?=bonusCreditNotification()?>');
    if(response.isAlreadyNotNotified == true){
        $('.credits-display-text').text(response.credits.credits);
            creditBadgeShow();
    }
</script>
</html>