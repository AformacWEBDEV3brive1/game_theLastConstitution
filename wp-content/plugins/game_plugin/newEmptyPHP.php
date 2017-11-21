<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ALTER TABLE `type_objet`
  ADD CONSTRAINT `type_objet_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `objet` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `class_objet`
  ADD CONSTRAINT `class_objet_ibfk_1` FOREIGN KEY (`id_class`) REFERENCES `objet` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `coffre_ville`
  ADD CONSTRAINT `coffreville_ibfk_1` FOREIGN KEY (`id_objet`) REFERENCES `objet` (`id_objet`) ON DELETE CASCADE ON UPDATE CASCADE;