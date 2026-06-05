package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.PromotionRequest;
import com.example.pos_hcsdl.dto.PromotionResponse;
import com.example.pos_hcsdl.entity.*;
import com.example.pos_hcsdl.mapper.MenuMapper;
import com.example.pos_hcsdl.mapper.PromotionMapper;
import com.example.pos_hcsdl.repository.MenuRepository;
import com.example.pos_hcsdl.repository.PromotionMenuRepository;
import com.example.pos_hcsdl.repository.PromotionRepository;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import jakarta.persistence.EntityManager;
import jakarta.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PromotionService {
    @Autowired
    private EntityManager entityManager;
    @Autowired
    private PromotionRepository promotionRepository;
    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private MenuRepository menuRepository;

    @Autowired
    private PromotionMenuRepository promotionMenuRepository;

    @Autowired
    private PromotionMapper promotionMapper;

    @Autowired
    private MenuMapper menuMapper;

    public PromotionResponse createPromotion(PromotionRequest promotionRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));

        Promotion promotion = promotionMapper.getPromotion(promotionRequest);
        promotion.setStatus("ACTIVE");
        promotion.setRestaurant(restaurant);

        Promotion promotionSaved = promotionRepository.save(promotion);

        promotionRequest.getMenus().forEach(menuId -> {
            Menu menu = menuRepository.findById(menuId)
                    .orElseThrow(() -> new RuntimeException("Menu not found"));
            PromotionMenuId id = new PromotionMenuId();
            id.setPromotionId(promotionSaved.getId());
            id.setMenuId(menuId);
            PromotionMenu promotionMenu = new PromotionMenu();
            promotionMenu.setId(id);
            promotionMenu.setMenu(menu);
            promotionMenu.setPromotion(promotionSaved);
            promotionMenuRepository.save(promotionMenu);
        });
        PromotionResponse promotionResponse = promotionMapper.getPromotionResponse(promotionSaved);
        promotionResponse.setMenus(promotionRequest.getMenus());
        return promotionResponse;
    }

    public List<PromotionResponse> findPromotionsByRestaurant(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));
        List<Promotion> promotions = promotionRepository.findAllByRestaurant(restaurant);

        return promotions.stream().map(promotion -> {
            List<PromotionMenu> promotionMenus = promotionMenuRepository.findAllByPromotion(promotion);
            PromotionResponse promotionResponse = promotionMapper.getPromotionResponse(promotion);
            promotionResponse.setMenus(promotionMenus.stream()
                    .map(promotionMenu -> promotionMenu.getMenu().getId()).toList());
            return promotionResponse;
        }).toList();
    }

    @Transactional
    public PromotionResponse updatePromotion(String promotionId, PromotionRequest promotionRequest) {
        Promotion promotion = promotionRepository.findById(promotionId)
                .orElseThrow(() -> new RuntimeException("Promotion not found"));
        promotion.setName(promotionRequest.getName());
        promotion.setApplyType(promotionRequest.getApplyType());
        promotion.setStartDate(promotionRequest.getStartDate());
        promotion.setEndDate(promotionRequest.getEndDate());
        promotion.setStartHour(promotionRequest.getStartHour());
        promotion.setEndHour(promotionRequest.getEndHour());
        promotion.setType(promotionRequest.getType());
        promotion.setValue(promotionRequest.getValue());

        promotionMenuRepository.deletePromotionMenuByPromotion(promotion);

        promotionRequest.getMenus().forEach(menuId -> {
            Menu menu = menuRepository.findById(menuId)
                    .orElseThrow(() -> new RuntimeException("Menu not found"));
            PromotionMenuId id = new PromotionMenuId();
            id.setPromotionId(promotion.getId());
            id.setMenuId(menuId);
            PromotionMenu promotionMenu = new PromotionMenu();
            promotionMenu.setId(id);
            promotionMenu.setMenu(menu);
            promotionMenu.setPromotion(promotion);
            promotionMenuRepository.save(promotionMenu);
        });

        PromotionResponse promotionResponse = promotionMapper.getPromotionResponse(promotion);
        promotionResponse.setMenus(promotionRequest.getMenus());
        return promotionResponse;
    }
}
