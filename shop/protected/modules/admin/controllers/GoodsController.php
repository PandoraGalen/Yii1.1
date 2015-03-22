<?php
/**
 * 后台商品管理控制器
 */
class GoodsController extends Controller {
	/*
	 * 商品展示
	 */
	function actionShow() {
		//通过模型model实现数据表信息查询
		//产生模型model对象
		$goods_model = Goods::model();

		//通过model模型对象调用相关方法帮我们查询数据
		// $goods_infos = $goods_model -> find();  //每次只可以查询一条商品信息
		// // var_dump($goods_infos);
		// echo $goods_infos->goods_name,"<br />";
		// echo $goods_infos->goods_price,"<br />";
		//
		//获得全部商品信息findAll()
		$goods_infos = $goods_model->findAll();
		//获得全部商品名字的信息
		// var_dump($goods_infos);
		// foreach($goods_infos as $_v){
		//     //$_v就是遍历出来的具体对象
		//     echo $_v->goods_name,"----",$_v->goods_price,"<br />";
		// }
		//
		//
		//通过具体sql语句获得商品信息findAllBySql()
		// $sql = "select goods_name,goods_price,goods_create_time from {{goods}} limit 10";
		// $goods_infos = $goods_model ->findAllBySql($sql);

		//var_dump($goods_infos);

		//
		//把获得数据信息传递到视图模板里边
		//renderPartial('视图名字',传递的变量信息);
		//renderPartial('show',array('名字'=>值,'名字'=>值));
		//名字：是视图使用的变量名字
		//值：当前被传递变量的值
		$this->renderPartial('show', array('goods_infos' => $goods_infos));
		// $this->renderPartial('show');
	}

	/*
	 * 添加商品
	 */
	function actionAdd() {
		$goods_model = new Goods();
		//echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";

		//判断表单是否有提交过来数据
		//$_POST['Goods']其中Goods有个好处，可以在当前控制器接收多个表单信息，只要下标有区分就可以
		if (isset($_POST['Goods'])) {
			//我们要把从表单提交过来的数据赋予$goods_model模型里边
			//$goods_model -> goods_name = $_POST['Goods']['goods_name'];
			//$goods_model -> goods_price = $_POST['Goods']['goods_price'];
			//$goods_model -> goods_number = $_POST['Goods']['goods_number'];
			//$goods_model -> goods_category_id = $_POST['Goods']['goods_category_id'];
			//$goods_model -> goods_brand_id = $_POST['Goods']['goods_brand_id'];
			//$goods_model -> goods_introduce = $_POST['Goods']['goods_introduce'];
			//$goods_model -> goods_weight = $_POST['Goods']['goods_weight'];

			//上边代码优化，利用foreach遍历来优化
			foreach ($_POST['Goods'] as $_k => $_v) {
				$goods_model->$_k = $_v;
			}
			$goods_model->goods_create_time = time();

			//调用save()方法实现数据添加
			if ($goods_model->save()) {
				//信息添加成功后实现页面重定向（商品列表页面）
				$this->redirect('./index.php?r=admin/goods/show');
			}
		}

		$this->renderPartial('add', array('goods_model' => $goods_model));
	}

	/*
	 * 修改商品
	 */
	function actionUpdate() {
		$this->renderPartial('update');
	}

	/*
	 * 通过模型实现数据添加
	 * 测试方法
	 */
	function actionJia() {
		//1 创建模型对象出来
		$goods_model = new Goods(); //我们需要添加数据，创建对象方式有别与查询

		//2. 为对象丰富属性 goods_name,goods_price,goods_weight，等等
		$goods_model->goods_name = "Apple 5s";
		$goods_model->goods_price = 5199;
		$goods_model->goods_weight = 103;

		//3. 调用save()方法实现数据添加
		if ($goods_model->save()) {
			echo "success";
		} else {
			echo "fail";
		}

	}
}