package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Promotion;
import com.example.pos_hcsdl.entity.PromotionMenu;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface PromotionMenuRepository extends JpaRepository<PromotionMenu, String> {
    List<PromotionMenu> findAllByPromotion(Promotion promotion);

    void deletePromotionMenuByPromotion(Promotion promotion);
}
