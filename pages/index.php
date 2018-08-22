<?php require_once("../config.php"); ?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<?php require_once(INCLUDE_PAGES_PATH . "html-head.php"); ?>
</head>

<body>

	<div id="wrapper">

		<?php require_once(INCLUDE_PAGES_PATH . "navigation.php"); ?>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">系統總覽</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<div class="huge"><?php $member_array = MemberReadAll(); echo count($member_array['payload']['objects']);?></div>
									<div>已登入隊員</div>
								</div>
							</div>
						</div>
						<a href="member/index.php">
							<div class="panel-footer">
								<span class="pull-left">查看詳細資料</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-green">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-life-ring fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
								<?php
									$member_alive_count = 0;
									foreach($member_array['payload']['objects'] as $member){
										if($member['status']==1)
											$member_alive_count++;
									}
								?>
									<div class="huge"><?php echo $member_alive_count;?></div>
									<div>存活隊員</div>
								</div>
							</div>
						</div>
						<a href="member/index.php">
							<div class="panel-footer">
								<span class="pull-left">查看詳細資料</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-yellow">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-check fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
								<?php
									$missions = MissionReadAll();
									$report_count = 0;
									foreach($missions['payload']['objects'] as $mission){
										$report_count += count(ReportReadByMissionId($mission['mid']));
									}
								?>
									<div class="huge"><?php echo $report_count;?></div>
									<div>已回報任務</div>
								</div>
							</div>
						</div>
						<a href="mission/index.php">
							<div class="panel-footer">
								<span class="pull-left">查看詳細資料</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-red">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-exclamation-circle fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
								<?php
									$missions = MissionReadAll();
									$report_unviewed_count = 0;
									foreach($missions['payload']['objects'] as $mission){
										$report_array = ReportReadByMissionId($mission['mid']);
										if(!isset($report_array['payload'])) continue;
										$report_array = $report_array['payload']['objects'];
										foreach($report_array as $report){
                                        	if($report['status'] != 0) continue;
                                        	$report_unviewed_count++;
										}
									}
								?>
									<div class="huge"><?php echo $report_unviewed_count;?></div>
									<div>未審核回報</div>
								</div>
							</div>
						</div>
						<a href="report/index.php">
							<div class="panel-footer">
								<span class="pull-left">查看詳細資料</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-bar-chart-o fa-fw"></i> 小隊分數統計
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped">
											<thead>
												<tr>
													<th>小隊別</th>
													<th>存活人數 / 總人數</th>
													<th>金錢總計</th>
													<th>分數總計</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$member_array = MemberReadAll();
												$live_cnt = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
												$total_cnt = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
												$money = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
												$score = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
												foreach($member_array['payload']['objects'] as $member){
													if(0) continue;
													$squad = $member['squad'];
													$total_cnt[$squad]++;
													$money[$squad]+=$member['money'];
													$score[$squad]+=$member['score'];
													if($member['status']==1) $live_cnt[$squad]++;
												}

												for($i=1; $i<=12; $i++){
													echo "
														<tr>
															<td>第 ".$i." 小隊</td>
															<td>".$live_cnt[$i]."/".$total_cnt[$i]."</td>
															<td>".$money[$i]."</td>
															<td>".$score[$i]."</td>
														</tr>
													";
												}
											?>
											</tbody>
										</table>
									</div>
									<!-- /.table-responsive -->
								</div>
								<!-- /.col-lg-12 (nested) -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-8 -->
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-bell fa-fw"></i> 系統事件
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div class="list-group">
								<a href="#" class="list-group-item">
									<i class="fa fa-comment fa-fw"></i> New Comment
									<span class="pull-right text-muted small"><em>4 minutes ago</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-twitter fa-fw"></i> 3 New Followers
									<span class="pull-right text-muted small"><em>12 minutes ago</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-envelope fa-fw"></i> Message Sent
									<span class="pull-right text-muted small"><em>27 minutes ago</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-tasks fa-fw"></i> New Task
									<span class="pull-right text-muted small"><em>43 minutes ago</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-upload fa-fw"></i> Server Rebooted
									<span class="pull-right text-muted small"><em>11:32 AM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-bolt fa-fw"></i> Server Crashed!
									<span class="pull-right text-muted small"><em>11:13 AM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-warning fa-fw"></i> Server Not Responding
									<span class="pull-right text-muted small"><em>10:57 AM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
									<span class="pull-right text-muted small"><em>9:49 AM</em>
									</span>
								</a>
								<a href="#" class="list-group-item">
									<i class="fa fa-money fa-fw"></i> Payment Received
									<span class="pull-right text-muted small"><em>Yesterday</em>
									</span>
								</a>
							</div>
							<!-- /.list-group -->
							<a href="#" class="btn btn-default btn-block">View All Alerts</a>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-4 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<?php require_once(INCLUDE_PAGES_PATH . "html-body-js.php"); ?>

</body>

</html>
