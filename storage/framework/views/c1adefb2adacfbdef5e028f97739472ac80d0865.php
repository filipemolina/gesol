<?php $__env->startSection('titulo'); ?>

	Dashboard | Principal

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-3">
    <div class="card card-chart">
        <div class="card-header" data-background-color="orange" data-header-animation="true">
            <div class="ct-chart" id="dailySalesChart"></div>
        </div>
        <div class="card-content">
            <div class="card-actions">
                <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                    <i class="material-icons">build</i> Fix Header!
                </button>
                <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="Refresh">
                    <i class="material-icons">refresh</i>
                </button>
                <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="Change Date">
                    <i class="material-icons">edit</i>
                </button>
            </div>
            <h4 class="card-title">Daily Sales</h4>
            <p class="category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
        </div>
        <div class="card-footer">
            <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.material', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>