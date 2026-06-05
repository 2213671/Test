package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.*;
import com.example.pos_hcsdl.entity.*;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.*;
import com.example.pos_hcsdl.repository.*;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import jakarta.persistence.EntityManager;
import jakarta.persistence.ParameterMode;
import jakarta.persistence.PersistenceContext;
import jakarta.persistence.StoredProcedureQuery;
import jakarta.transaction.Transactional;
import lombok.RequiredArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.RequestHeader;
import org.springframework.web.bind.annotation.RequestParam;

import java.math.BigDecimal;
import java.math.RoundingMode;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.*;
import java.util.stream.Collectors;

@Service
@RequiredArgsConstructor
public class OrderService {

    @Autowired
    private EntityManager entityManager;

    @Autowired
    private OrderMapper orderMapper;

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private RestaurantTableRepository restaurantTableRepository;

    @Autowired
    private ShiftRepository shiftRepository;

    @Autowired
    private OrderRepository orderRepository;

    @Autowired
    private OrderItemRepository orderItemRepository;

    @Autowired
    private OrderSubItemRepository orderSubItemRepository;

    @Autowired
    private ProductRepository productRepository;

    @Autowired
    private ToppingRepository toppingRepository;

    @Autowired
    private OptionRepository optionRepository;

    @Autowired
    private OrderItemHistoryRepository orderItemHistoryRepository;

    @Autowired
    private PromotionRepository promotionRepository;

    @Autowired
    private PromotionMapper promotionMapper;

    @Autowired
    private OrderSubItemHistoryRepository orderSubItemHistoryRepository;

    @Autowired
    private OrderItemService orderItemService;

    @Autowired
    private PromotionOrderRepository promotionOrderRepository;

    @Autowired
    private PromotionMenuRepository promotionMenuRepository;

    @Autowired
    private ObjectMapper objectMapper = new ObjectMapper();

    @Autowired
    private OrderSubItemMapper orderSubItemMapper;
    @Autowired
    private PromotionOrderMapper promotionOrderMapper;


    public OrderResponse applyPromotion(String orderId, String promotionId) {
        Order order = orderRepository.findById(orderId).orElseThrow(
                () -> new RuntimeException("Order Not Found!"));
        if (!orderRepository.checkOrderPromotionApply(orderId, promotionId)) {
            throw new BadRequestException("Apply not valid");
        }
        return getOrderResponse(order, promotionId);
    }

    public OrderResponse getOrderById(String orderId) {
        Order order = orderRepository.findById(orderId).orElseThrow(
                () -> new RuntimeException("Order Not Found!"));

        return getOrderResponse(order, null);
    }


    public OrderResponse createOrder(OrderRequest orderRequest) {
        if (orderRequest.getShiftId() == null) {
            throw new BadRequestException("Shift Id is Required");
        }
        User creator = userRepository.findById(orderRequest.getCreatorId())
                .orElseThrow(() -> new RuntimeException("User Not Found!"));
        RestaurantTable restaurantTable = restaurantTableRepository.findById(orderRequest.getTableId())
                .orElseThrow(() -> new RuntimeException("Restaurant Table Not Found!"));
        Shift shift = shiftRepository.findById(orderRequest.getShiftId())
                .orElseThrow(() -> new RuntimeException("Shift Not Found!"));

        ObjectMapper mapper = new ObjectMapper();
        String orderId;
        try {
            String json = mapper.writeValueAsString(orderRequest.getItems());
            orderId = orderRepository.createOrder(orderRequest.getCreatorId(), orderRequest.getTableId()
                    , orderRequest.getShiftId(), orderRequest.getCustomerCount(), json);
        } catch (JsonProcessingException e) {
            throw new RuntimeException(e);
        }

//        orderRequest.getItems().stream().forEach(item -> {
//            saveHistory(item, order, action, orderItemSaved.getName(), orderItemSaved.getPrice(), orderItemSaved.getId(), requestId);
//        })
        return getOrderResponse(orderRepository.findById(orderId).orElse(null), null);
    }

    private OrderResponse getOrderResponse(Order order, String promotionId) {
        OrderResponse orderResponse = orderMapper.entityToResponse(order);

        List<OrderItemDTO> orderItemDTOS = orderRepository.getOrderItem(order.getId(), promotionId);
        orderItemDTOS.forEach(orderItemDTO -> {
            List<OrderSubItemResponse> orderSubItemResponses = orderSubItemMapper.entityToResponseList(orderSubItemRepository.getSubIemByOrderItemId(orderItemDTO.getId()));
            orderItemDTO.setSubItems(orderSubItemResponses);
        });

        orderResponse.setOrderItems(orderItemDTOS);
        if (promotionId != null) {
            BigDecimal promotionPrice = orderRepository.getDiscountByOrder(order.getId(), promotionId);
            promotionPrice = promotionPrice != null ? promotionPrice : BigDecimal.ZERO;

            orderResponse.setAmountDiscount(promotionPrice);

            orderResponse.setFinalAmount(
                    orderResponse.getFinalAmount().subtract(promotionPrice)
            );
        }

        orderResponse.setPromotion(promotionOrderMapper.getPromotionOrderResponse(promotionOrderRepository.findByOrder(order).orElse(null)));

        return orderResponse;
    }

    public OrderResponse addOrder(OrderAddRequest orderAddRequest) {

        Order order = orderRepository.findById(orderAddRequest.getOrderId())
                .orElseThrow(() -> new RuntimeException("Order Not Found!"));
        ObjectMapper mapper = new ObjectMapper();
        try {
            String json = mapper.writeValueAsString(orderAddRequest.getItems());
            orderRepository.addOrder(order.getId(), json);
        } catch (JsonProcessingException e) {
            throw new RuntimeException(e);
        }

        return getOrderResponse(orderRepository.findById(order.getId()).orElse(null), null);
    }

    @Transactional
    public OrderResponse paymentOrder(PaymentRequest paymentRequest) {
        Order order = orderRepository.findById(paymentRequest.getOrderId())
                .orElseThrow(() -> new RuntimeException("Order Not Found!"));
        if (order.getOrderStatus().equals("COMPLETED")) {
            throw new BadRequestException("Order has already been completed!");
        }
        BigDecimal totalAmountReceivedFromCustomer = paymentRequest.getPaymentMethods()
                .stream()
                .map(PaymentTotalRequest::getAmount)
                .reduce(BigDecimal.ZERO, BigDecimal::add);

        try {
            String paymentMethodsJson = objectMapper.writeValueAsString(paymentRequest.getPaymentMethods());
            order.setPaymentMethod(paymentMethodsJson);
        } catch (JsonProcessingException e) {
            e.printStackTrace();
        }

        BigDecimal finalAmount = BigDecimal.ZERO;
        BigDecimal amountDiscount = BigDecimal.ZERO;

        if (paymentRequest.getPromotionId() != null) {
            Promotion prom = promotionRepository.findById(paymentRequest.getPromotionId())
                    .orElseThrow(() -> new RuntimeException("Promotion Not Found!"));
            PromotionResponse promotion = promotionMapper.getPromotionResponse(prom);
            List<String> promotionMenus = promotionMenuRepository.findAllByPromotion(prom)
                    .stream().map((p) -> p.getMenu().getId()).toList();
            LocalDateTime dateTime = LocalDateTime.now();
            LocalTime time = LocalTime.now();

            if (!promotion.getStatus().equals("ACTIVE")) {
                throw new BadRequestException("Promotion is not Active!");
            }

            if (dateTime.isBefore(promotion.getStartDate()) || dateTime.isAfter(promotion.getEndDate())) {
                throw new BadRequestException("Promotion is not available today");
            }

            if (time.isBefore(promotion.getStartHour()) || time.isAfter(promotion.getEndHour())) {
                throw new BadRequestException("Promotion is not available at this time");
            }
            if (promotion.getApplyType().equals("ORDER")) {
                if (promotion.getType().equals("PERCENT")) {
                    BigDecimal discount = order.getTotalPrice()
                            .multiply(promotion.getValue())
                            .divide(new BigDecimal("100"), 2, RoundingMode.HALF_UP);
                    finalAmount = order.getTotalPrice().subtract(discount);
                    amountDiscount = discount;
                } else {
                    finalAmount = order.getTotalPrice().subtract(promotion.getValue());
                    amountDiscount = promotion.getValue();
                }

            } else {
                List<OrderItemResponse> orderItemResponses = orderItemService.findOrderItemsByOrderId(order.getId());
                BigDecimal discount = orderItemResponses.stream()
                        .map(item -> {
                            boolean hasMenu = promotionMenus.stream()
                                    .anyMatch(m -> m.equals(item.getMenuId()));
                            if (!hasMenu) {
                                return BigDecimal.ZERO;
                            }
                            if ("PERCENT".equals(promotion.getType())) {
                                return item.getPrice()
                                        .multiply(new BigDecimal(item.getQuantity()))
                                        .multiply(promotion.getValue())
                                        .divide(new BigDecimal("100"), 2, RoundingMode.HALF_UP);
                            } else {
                                return promotion.getValue()
                                        .multiply(new BigDecimal(item.getQuantity()));
                            }
                        })
                        .reduce(BigDecimal.ZERO, BigDecimal::add);
                amountDiscount = discount;
                finalAmount = order.getTotalPrice().subtract(discount);
            }
            PromotionOrder promotionOrder = new PromotionOrder();
            promotionOrder.setOrder(order);
            promotionOrder.setApplyOrderType(promotion.getApplyType());
            promotionOrder.setPromotionName(promotion.getName());
            promotionOrder.setPromotionId(promotion.getId());
            promotionOrder.setAmountAfterPromotion(finalAmount);
            promotionOrder.setAmountBeforePromotion(order.getTotalPrice());
            promotionOrder.setApplyAt(dateTime);
            promotionOrder.setPromotionValue(promotion.getValue());
            promotionOrder.setPromotionType(promotion.getType());
            order.setPromotionOrder(promotionOrderRepository.save(promotionOrder));

        } else {
            finalAmount = order.getTotalPrice();
        }

        if (totalAmountReceivedFromCustomer.compareTo(finalAmount) < 0) {
            throw new BadRequestException("Total amount received from customer is not enough" + finalAmount);
        }
        order.setAmountDiscount(amountDiscount);
        order.setFinalAmount(finalAmount);
        order.setAmountReceivedFromCustomer(totalAmountReceivedFromCustomer);
        order.setAmountChangeGivenToCustomer(totalAmountReceivedFromCustomer.subtract(finalAmount));
        order.setOrderStatus("COMPLETED");
        RestaurantTable table = restaurantTableRepository.findById(order.getTableId())
                .orElseThrow(() -> new RuntimeException("Restaurant Table Not Found!"));
        table.setOrderId(null);
        table.setCustomerCount(null);
        table.setTotalPrice(null);
        table.setTotalItem(null);
        table.setStatus("BLANK");
        restaurantTableRepository.save(table);

        return orderMapper.entityToResponse(orderRepository.save(order));
    }

    public LookupOrderResponse getOrderLookup(String orderStatus,
                                              LocalDate startDate,
                                              LocalDate endDate,
                                              Integer pageSize,
                                              Integer pageNo,
                                              String restaurantId) {

        String status = orderStatus != null ? orderStatus : "ALL";
        List<Order> orders = orderRepository.getOrdersLookup(startDate, endDate, status, pageSize, pageNo * pageSize, restaurantId);

        List<OrderResponse> orderResponses = orders.stream().map(order -> {
            return getOrderResponse(order, order.getPromotionOrder() != null ? order.getPromotionOrder().getId() : null);
        }).toList();

        long totalElements = orderRepository.getTotalOrdersLookup(startDate, endDate, status, restaurantId);

        LookupOrderResponse lookupOrderResponse = new LookupOrderResponse();
        lookupOrderResponse.setPageSize(pageSize);
        lookupOrderResponse.setPageNo(pageNo);
        lookupOrderResponse.setContent(orderResponses);
        lookupOrderResponse.setTotalPages((long) Math.ceil((double) totalElements / pageSize));
        lookupOrderResponse.setTotalElements(totalElements);
        return lookupOrderResponse;
    }
}
