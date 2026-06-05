package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.OrderSubItemResponse;
import com.example.pos_hcsdl.entity.Option;
import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.entity.OrderSubItem;
import com.example.pos_hcsdl.entity.Topping;
import com.example.pos_hcsdl.mapper.OrderSubItemMapper;
import com.example.pos_hcsdl.repository.OptionRepository;
import com.example.pos_hcsdl.repository.OrderItemRepository;
import com.example.pos_hcsdl.repository.OrderSubItemRepository;
import com.example.pos_hcsdl.repository.ToppingRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.math.BigDecimal;
import java.util.List;

@Service
public class OrderSubItemService {

    @Autowired
    private OrderSubItemRepository orderSubItemRepository;

    @Autowired
    private OrderItemRepository orderItemRepository;

    @Autowired
    private OrderSubItemMapper orderSubItemMapper;

    @Autowired
    private ToppingRepository toppingRepository;

    @Autowired
    private OptionRepository optionRepository;


    public OrderSubItem createOrderSubItem(Long quantity,String itemType, String itemId, OrderItem orderItem) {


        OrderSubItem orderSubItem = new OrderSubItem();

        if (itemType.equals("TOPPING")) {
            Topping topping = toppingRepository.findById(itemId)
                    .orElseThrow(() -> new RuntimeException("topping not found"));
            orderSubItem.setName(topping.getName());
            orderSubItem.setPrice(topping.getPrice());
        } else if (itemType.equals("OPTION")) {
            Option option = optionRepository.findById(itemId)
                    .orElseThrow(() -> new RuntimeException("option not found"));
            orderSubItem.setName(option.getName());
            orderSubItem.setPrice(option.getPrice());
        }
        orderSubItem.setQuantity(quantity);
        orderSubItem.setOrderItem(orderItem);
        orderSubItem.setItemType(itemType);
        orderSubItem.setItemId(itemId);

        return orderSubItemRepository.save(orderSubItem);
    }
}
