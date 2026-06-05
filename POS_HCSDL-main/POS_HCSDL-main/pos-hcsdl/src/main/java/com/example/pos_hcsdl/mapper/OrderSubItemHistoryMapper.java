package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.OrderItemHistoryResponse;
import com.example.pos_hcsdl.dto.OrderSubItemHistoryResponse;
import com.example.pos_hcsdl.entity.OrderItemHistory;
import com.example.pos_hcsdl.entity.OrderSubItemHistory;
import org.mapstruct.Mapper;

import java.util.List;

@Mapper(componentModel = "spring")
public interface OrderSubItemHistoryMapper {

    OrderSubItemHistoryResponse getOrderSubItemHistoryResponse(OrderSubItemHistory orderSubItemHistory);

    List<OrderSubItemHistoryResponse> getOrderSubItemHistoryResponseList(List<OrderSubItemHistory> orderSubItemHistoryList);
}
