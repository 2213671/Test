package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.PromotionRequest;
import com.example.pos_hcsdl.dto.PromotionResponse;
import com.example.pos_hcsdl.service.PromotionService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "8. Promotion Management")
@RestController
@RequestMapping("/promotion")
public class PromotionController {

    @Autowired
    private PromotionService promotionService;

    @PostMapping("/create-promotion")
    public PromotionResponse createPromotion(
            @RequestBody PromotionRequest promotionRequest,
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return promotionService.createPromotion(promotionRequest, restaurantId);
    }

    @GetMapping("/restaurant/{id}")
    public List<PromotionResponse> getPromotionsByRestaurant(@PathVariable String id) {
        return promotionService.findPromotionsByRestaurant(id);
    }

    @PutMapping("/{id}")
    public PromotionResponse updatePromotionById(@PathVariable String id, @RequestBody PromotionRequest promotionRequest) {
        return promotionService.updatePromotion(id, promotionRequest);
    }
}
