package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.PromotionOrderResponse;
import com.example.pos_hcsdl.entity.PromotionOrder;
import org.mapstruct.Mapper;

import java.util.List;

@Mapper(componentModel = "spring")
public interface PromotionOrderMapper {

    PromotionOrderResponse getPromotionOrderResponse(PromotionOrder PromotionOrder);

    List<PromotionOrderResponse> getPromotionOrderResponseList(List<PromotionOrder> PromotionOrders);
}
