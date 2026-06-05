package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.PaymentMethodRequest;
import com.example.pos_hcsdl.dto.PaymentMethodResponse;
import com.example.pos_hcsdl.service.PaymentMethodService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "9. Payment Method Management")
@RestController
@RequestMapping("/payment-method")
public class PaymentMethodController {

    @Autowired
    private PaymentMethodService paymentMethodService;

    @PostMapping("/create")
    public PaymentMethodResponse createPaymentMethod(
            @RequestBody PaymentMethodRequest paymentMethodRequest,
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return paymentMethodService.createPaymentMethod(paymentMethodRequest, restaurantId);
    }

    @GetMapping("/restaurant/{id}")
    public List<PaymentMethodResponse> getPaymentMethodsByRestaurant(@PathVariable String id) {
        return paymentMethodService.findPaymentMethodsByRestaurant(id);
    }

    @PutMapping("/{id}")
    public PaymentMethodResponse updatePaymentMethodById(@PathVariable String id, @RequestBody PaymentMethodRequest paymentMethodRequest) {
        return paymentMethodService.updatePaymentMethod(id, paymentMethodRequest);
    }
}
