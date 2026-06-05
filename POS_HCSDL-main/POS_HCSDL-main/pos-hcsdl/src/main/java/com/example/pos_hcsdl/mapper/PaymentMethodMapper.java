package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.PaymentMethodRequest;
import com.example.pos_hcsdl.dto.PaymentMethodResponse;
import com.example.pos_hcsdl.entity.PaymentMethod;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

import java.util.List;

@Mapper(componentModel = "spring")
public interface PaymentMethodMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    PaymentMethodResponse getPaymentMethodResponse(PaymentMethod paymentMethod);

    PaymentMethod getPaymentMethod(PaymentMethodRequest PaymentMethodRequest);

    List<PaymentMethodResponse> getPaymentMethodResponseList(List<PaymentMethod> paymentMethods);
}
