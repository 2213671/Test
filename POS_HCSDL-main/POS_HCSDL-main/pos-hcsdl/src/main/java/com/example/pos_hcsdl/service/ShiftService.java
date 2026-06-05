package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.CurrentShift;
import com.example.pos_hcsdl.dto.PaymentTotalRequest;
import com.example.pos_hcsdl.dto.ShiftResponse;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.entity.Shift;
import com.example.pos_hcsdl.entity.User;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.ShiftMapper;
import com.example.pos_hcsdl.repository.OrderRepository;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import com.example.pos_hcsdl.repository.ShiftRepository;
import com.example.pos_hcsdl.repository.UserRepository;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import java.math.BigDecimal;
import java.time.ZoneId;
import java.util.*;

@Service
public class ShiftService {


    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private ShiftRepository shiftRepository;

    @Autowired
    private ShiftMapper shiftMapper;

    @Autowired
    private OrderRepository orderRepository;

    @Autowired
    private ObjectMapper objectMapper = new ObjectMapper();


    public CurrentShift openShift(String openerId, String restaurantId) {
        shiftRepository.findCurrentShift(restaurantId)
                .ifPresent(shift -> {
                    throw new ResponseStatusException(HttpStatus.CONFLICT, "Current shift already exists");
                });
        User opener = userRepository.findById(openerId)
                .orElseThrow(() -> new RuntimeException("User not found"));
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new RuntimeException("Restaurant not found"));
        Shift shift = new Shift();
        shift.setOpener(opener);
        Date date = new Date();
        shift.setOpenAt(date.toInstant().atZone(ZoneId.systemDefault()) // đặt múi giờ
                .toLocalDateTime());
        shift.setRestaurant(restaurant);
        return shiftMapper.getCurrentShift(shiftRepository.save(shift));
    }

    public CurrentShift closeShift(String closerId, String restaurantId) {
        User closer = userRepository.findById(closerId)
                .orElseThrow(() -> new BadRequestException("User not found"));

        Shift shift = shiftRepository.findCurrentShift(restaurantId)
                .orElseThrow(() -> new BadRequestException("Current shift is closed"));

        List<Order> orders = orderRepository.findAllByShift(shift);
        boolean hasInProgress = orders.stream()
                .anyMatch(o -> o.getOrderStatus().equals("IN_PROGRESS"));
        if (hasInProgress) {
            throw new BadRequestException("Shift has order in progress");
        }
        shift.setCloser(closer);
        Date date = new Date();
        shift.setCloseAt(date.toInstant().atZone(ZoneId.systemDefault())
                .toLocalDateTime());
        return shiftMapper.getCurrentShift(shiftRepository.save(shift));
    }

    public CurrentShift getCurrentShift(String restaurantId) {
        Shift currentShift = shiftRepository.findCurrentOrLastShift(restaurantId)
                .orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Current shift not found"));


        return shiftMapper.getCurrentShift(currentShift);
    }

    public ShiftResponse getInformationShift(String shiftId) {
        Shift shift = shiftRepository.findById(shiftId)
                .orElseThrow(() -> new BadRequestException("Current shift not found"));

        List<Order> orders = orderRepository.findAllByShift(shift);
        BigDecimal totalPrice = BigDecimal.ZERO;
        BigDecimal totalDiscount = BigDecimal.ZERO;
        BigDecimal totalChangeGivenToCustomer = BigDecimal.ZERO;
        BigDecimal totalReceivedFromCustomer = BigDecimal.ZERO;
        long totalItem = 0L;

        Map<String, BigDecimal> payments = new HashMap<>();

        for (Order order : orders) {
            totalPrice = totalPrice.add(Optional.ofNullable(order.getFinalAmount()).orElse(BigDecimal.ZERO));
            totalItem = totalItem + Optional.ofNullable(order.getTotalItem()).orElse(0L);
            totalDiscount = totalDiscount.add(Optional.ofNullable(order.getAmountDiscount()).orElse(BigDecimal.ZERO));
            totalReceivedFromCustomer = totalReceivedFromCustomer.add(Optional.ofNullable(order.getAmountReceivedFromCustomer()).orElse(BigDecimal.ZERO));
            totalChangeGivenToCustomer = totalChangeGivenToCustomer.add(Optional.ofNullable(order.getAmountChangeGivenToCustomer()).orElse(BigDecimal.ZERO));
            if (order.getOrderStatus().equals("COMPLETED")) {
                List<PaymentTotalRequest> methods = null;
                try {
                    methods = objectMapper.readValue(
                            order.getPaymentMethod(),
                            new TypeReference<List<PaymentTotalRequest>>() {
                            }
                    );
                } catch (JsonProcessingException e) {
                    throw new RuntimeException(e);
                }

                for (PaymentTotalRequest method : methods) {
                    payments.put(method.getName(), method.getAmount().add(Optional.ofNullable(payments.get(method.getName())).orElse(BigDecimal.ZERO)));
                }
            }
        }

        ShiftResponse shiftResponse = shiftMapper.getShiftResponse(shift);
        shiftResponse.setTotalAmount(totalPrice);
        shiftResponse.setTotalItem(totalItem);
        shiftResponse.setTotalAmountChangeGivenToCustomer(totalChangeGivenToCustomer);
        shiftResponse.setTotalAmountDiscount(totalDiscount);
        shiftResponse.setTotalAmountReceivedFromCustomer(totalReceivedFromCustomer);
        shiftResponse.setTotalOrder((long) orders.size());
        List<PaymentTotalRequest> paymentList = payments.entrySet()
                .stream()
                .map(e -> {
                    PaymentTotalRequest paymentTotalRequest = new PaymentTotalRequest();
                    paymentTotalRequest.setName(e.getKey());
                    paymentTotalRequest.setAmount(e.getValue());
                    return paymentTotalRequest;
                })
                .toList();
        shiftResponse.setAmountPaymentMethods(paymentList);

        return shiftResponse;
    }
}
