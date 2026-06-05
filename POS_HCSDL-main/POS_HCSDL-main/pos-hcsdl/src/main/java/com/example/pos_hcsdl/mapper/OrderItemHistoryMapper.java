package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.OrderItemHistoryResponse;
import com.example.pos_hcsdl.entity.OrderItemHistory;
import org.mapstruct.Mapper;

import java.util.List;

@Mapper(componentModel = "spring")
public interface OrderItemHistoryMapper {

    OrderItemHistoryResponse getOrderItemHistoryResponse(OrderItemHistory orderItemHistory);

    List<OrderItemHistoryResponse> getOrderItemHistoryResponseList(List<OrderItemHistory> orderItemHistories);
}
