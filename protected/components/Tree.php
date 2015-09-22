<?php

class Tree extends CWidget {
    public function run() {
        $model = Department::model()->findByPK(1);
        $tree = $model->getTreeViewData(false);
        $this->render('tree',array('tree'=>$tree,));
    }
}
 