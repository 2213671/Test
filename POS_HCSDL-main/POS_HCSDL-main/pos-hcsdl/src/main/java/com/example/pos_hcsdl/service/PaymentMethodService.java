package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.PaymentMethodRequest;
import com.example.pos_hcsdl.dto.PaymentMethodResponse;
import com.example.pos_hcsdl.entity.PaymentMethod;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.PaymentMethodMapper;
import com.example.pos_hcsdl.repository.PaymentMethodRepository;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PaymentMethodService {

    @Autowired
    private PaymentMethodRepository paymentMethodRepository;

    @Autowired
    private PaymentMethodMapper paymentMethodMapper;

    @Autowired
    private RestaurantRepository restaurantRepository;

    public List<PaymentMethodResponse> findPaymentMethodsByRestaurant(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));
        return paymentMethodMapper.getPaymentMethodResponseList(paymentMethodRepository.findAllByRestaurant(restaurant));
    }

    public PaymentMethodResponse createPaymentMethod(PaymentMethodRequest paymentMethodRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));
        PaymentMethod paymentMethod = paymentMethodMapper.getPaymentMethod(paymentMethodRequest);
        paymentMethod.setStatus("ACTIVE");
        paymentMethod.setRestaurant(restaurant);

        return paymentMethodMapper.getPaymentMethodResponse(paymentMethodRepository.save(paymentMethod));
    }

    public PaymentMethodResponse updatePaymentMethod(String paymentMethodId, PaymentMethodRequest paymentMethodRequest ) {
        PaymentMethod paymentMethod = paymentMethodRepository.findById(paymentMethodId)
                .orElseThrow(() -> new BadRequestException("PaymentMethod not found"));
        paymentMethod.setCode(paymentMethodRequest.getCode());
        paymentMethod.setName(paymentMethodRequest.getName());
        return paymentMethodMapper.getPaymentMethodResponse(paymentMethodRepository.save(paymentMethod));
    }
}
