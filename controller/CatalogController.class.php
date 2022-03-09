<?php

    class CatalogController extends BaseController {

        protected function before() {
            $this -> heading = "New arrivals";
            $this -> title .= " | " . $this -> heading;
            $this -> view = "catalog";
            $this -> bc = array(
                "visible" => "",
                "first" => "Home",
                "second" => "Men",
                "last" => "New arrivals"
            );
            $this -> menu = array(
                'find' => true,
                'right' => true
            );
        }

        public function show($params) {
            $part = isset($params['id']) ? (int)$params['id'] : 1;
            $catalog = new Catalog;
            $nextPart = (($part * GOODS_IN_PART) < $catalog -> getCountOfGoods()) ? $part + 1  : 0;
            $result = array(
                'isShowBtnVisible' => ($catalog -> getCountOfGoods() > GOODS_IN_PART) ? "" : " dont_show",
                'nextPart' => $nextPart,
                'goods' => $catalog -> getGoodsPage($part, GOODS_IN_PART),
            );
            return $result;
        }
    }