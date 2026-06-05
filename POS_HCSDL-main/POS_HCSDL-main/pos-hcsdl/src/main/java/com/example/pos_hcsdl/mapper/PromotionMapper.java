package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.PromotionRequest;
import com.example.pos_hcsdl.dto.PromotionResponse;
import com.example.pos_hcsdl.entity.Promotion;
import com.example.pos_hcsdl.entity.Restaurant;
import org.mapstruct.Mapper;

import java.util.List;

@Mapper(componentModel = "spring")
public interface PromotionMapper {

    PromotionResponse getPromotionResponse(Promotion promotion);

    Promotion getPromotion(PromotionRequest promotionRequest);

    List<PromotionResponse> getPromotionResponseList(List<Promotion> promotions);
}
