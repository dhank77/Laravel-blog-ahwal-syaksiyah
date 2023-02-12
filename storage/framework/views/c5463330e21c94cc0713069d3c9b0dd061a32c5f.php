<!-- JAVASCRIPT -->
<script src="<?php echo e(URL::asset('/assets/libs/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/bootstrap/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/metismenu/metismenu.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/node-waves/node-waves.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/feather-icons/feather-icons.min.js')); ?>"></script>
<!-- pace js -->
<script src="<?php echo e(URL::asset('assets/libs/pace-js/pace-js.min.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldContent('script-bottom'); ?>
<script src="<?php echo e(URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script>
    $(".swalDelete").click(function(event) {
        event.preventDefault();
        const href = event.currentTarget.href;
        Swal.fire({
            title: "Anda yakin menghapus data ini?",
            text: "Data tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1c84ee",
            cancelButtonColor: "#fd625e",
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })
   
</script>
<?php if(session()->has('success')): ?>
    <script>
         Swal.fire({
            title: "<?php echo e(session('success')); ?>",
            icon: "success",
        })
    </script>
<?php endif; ?>
<?php if(session()->has('error')): ?>
    <script>
         Swal.fire({
            title: "<?php echo e(session('error')); ?>",
            icon: "error",
        })
    </script>
<?php endif; ?>
<?php /**PATH /Users/hamdaniilham/Laravel/ahwal-syaksiyah/resources/views/layouts/vendor-scripts.blade.php ENDPATH**/ ?>