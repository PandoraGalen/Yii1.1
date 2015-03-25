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
		// $goods_infos = $goods_model->find();  //每次只可以查询一条商品信息
		// // var_dump($goods_infos);
		// echo $goods_infos->goods_name,"<br />";
		// echo $goods_infos->goods_price,"<br />";
		//
		//获得全部商品信息findAll()
		$goods_infos = $goods_model->findAll();
		//获得全部商品名字的信息
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
     * 建立一个测试方法，实现商品数据分页显示 
     */
    function actionShow1(){
        //获得数据模型
        $goods_model = Goods::model();
        //1.获得商品总的记录数目
        $cnt = $goods_model->count();
        $per = 3;

        // //2. 实例化分页类对象
         $page = new Pagination($cnt, $per);
        // //3. 重新按照分页的样式拼装sql语句进行查询
        $sql = "select * from {{goods}} $page->limit";
        $goods_infos = $goods_model->findAllBySql($sql);

        // //4. 获得分页页面列表(需要传递到视图模板里边显示)
         $page_list = $page->fpage(array(3,4,5,6,7));
        // //调用视图模板，给模板传递数据
        $this ->renderPartial('show',array('goods_infos'=>$goods_infos,'page_list'=>$page_list));
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
			//$goods_model->goods_name = $_POST['Goods']['goods_name'];
			//$goods_model->goods_price = $_POST['Goods']['goods_price'];
			//$goods_model->goods_number = $_POST['Goods']['goods_number'];
			//$goods_model->goods_category_id = $_POST['Goods']['goods_category_id'];
			//$goods_model->goods_brand_id = $_POST['Goods']['goods_brand_id'];
			//$goods_model->goods_introduce = $_POST['Goods']['goods_introduce'];
			//$goods_model->goods_weight = $_POST['Goods']['goods_weight'];

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
     * 当前这个方法在执行的时候需要get方式传递id信息
     * 如果没有id信息则此方法是不允许访问的
	 */
	function actionUpdate($id) {
        //我们具体修改哪个商品，需要将其信息查询出来
        //我们需要知道哪个商品被修改，把商品的id信息通过get方式传递过来
        //接收被修改商品id信息
        //根据$id查询被修改商品信息
        $goods_model = Goods::model();  //除了添加(new Goods)数据我们都使用Goods::model()来实例化模型对象
        $goods_info = $goods_model->findByPk($id);
        
        //修改逻辑与添加逻辑基本一致，创建表单、收集数据、赋予模型、调用save方法
        //修改的时候，数据也是赋予数据模型对象里边了
        //$goods_info数据模型里边有一些旧的信息，新的信息覆盖旧的信息
        if(isset($_POST['Goods'])){
            foreach($_POST['Goods'] as $_k=>$_v){
                $goods_info->$_k = $_v;
            }
            
            if($goods_info->save())
                $this->redirect('./index.php?r=admin/goods/show');
        }
        //创建数据模型model对象
        //new  Goods()  ;   调用save方法的时候给我们执行insert语句
        //Goods::model();    调用save方法的时候执行update语句
        
        //$goods_info是我们查询出来的被修改商品的信息，同时也是数据模型对象
        //把$goods_info传递到视图模板里边。
        
        $this->renderPartial('update', array('goods_model'=>$goods_info));
	}

    /*
     * 删除商品信息
     * 删除商品信息与修改类似，通过get方式传递被删除商品信息id
     */
    function actionDel($id){
        //根据$id将被删除商品的数据模型对象获得到，通过该对象调用 delete 方法即可删除数据
        $goods_model = Goods::model(); //获得数据模型对象
        $goods_info = $goods_model->findByPk($id);  //获得被删除商品的模型对象
        //是谁($goods_info还是$goods_model)调用delete
        if($goods_info->delete())
            $this->redirect('./index.php?r=admin/goods/show');
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

        function actionCeshi(){
        $model = Goods::model();
        
        //$infos = $model->findAllByPk(10);
        //$infos = $model->findAllByPk(array(1,5,12));
        //////////////////////////////////////////////////////////////////////////////////////////
        
        //findAll($condition,$param)
        //$condition  就是sql语句的where条件
        //查询诺基亚手机并且价格大于500元
        //$infos = $model->findAll("goods_name like '诺%' and goods_price>500");
        //为了避免sql注入的安全问题，sql语句里边最好不要直接写条件信息
        //$infos = $model->findAll("goods_name like :name and goods_price>:price",array(':name'=>'诺%',':price'=>500));
         //////////////////////////////////////////////////////////////////////////////////////////
         
        //有的时候我们查询信息，
        //想要查询具体的"字段" select
        //想要查询具体的"条件" condition
        //想要查询具体的"排序" order
        //想要查询具体的"分组" group
        //想要查询具体的"限制" limit
        //想要查询具体的"偏移量" offset
        
        //$infos = $model->findAll(array(
        //    'select'=>'goods_name,goods_price',
        //    'condition'=>"goods_name like '诺%'",
        //    'order'=>'goods_price desc',
        //    'limit'=>3,
        //    'offset'=>6,
        //));
        
         //////////////////////////////////////////////////////////////////////////////////////////
        //通过criteria实现信息的查询
        $criteria = new CDbCriteria();
        $criteria->select = "goods_name,goods_price";
        $criteria->condition = "goods_name like '摩%'";
        //$criteria->limit = 6;
        $criteria->order = "goods_price";
        $infos = $model->findAll($criteria);
        
        
        $this ->renderPartial('show',array('goods_infos'=>$infos));
        
        //save()方法执行update或insert
        //$model->save();
    }
}