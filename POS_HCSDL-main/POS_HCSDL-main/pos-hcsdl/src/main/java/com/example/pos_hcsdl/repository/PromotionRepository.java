package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Promotion;
import com.example.pos_hcsdl.entity.Restaurant;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface PromotionRepository extends JpaRepository<Promotion, String> {

    List<Promotion> findAllByRestaurant(Restaurant restaurant);
}
